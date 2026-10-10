<?php

/**
 * Prepares a release: computes the next version from the latest tag and the requested
 * bump (patch, minor or major), then moves the "Unreleased" sections of CHANGELOG.md
 * and UPGRADING.md under that version.
 *
 * Usage: php .github/scripts/prepare-release.php patch|minor|major
 */
const CHANGELOG = 'CHANGELOG.md';
const UPGRADING = 'UPGRADING.md';

/**
 * Stops the release with an error message displayed by GitHub Actions.
 */
function fail(string $message): never
{
    fwrite(STDERR, "::error::$message\n");

    exit(1);
}

/**
 * Returns the content of the section introduced by the given heading, without the surrounding blank lines.
 */
function sectionContent(string $markdown, string $heading): string
{
    $start = strpos($markdown, "\n$heading\n");
    if ($start === false) {
        return '';
    }

    $start += strlen($heading) + 2;
    $end = strpos($markdown, "\n## ", $start);

    return trim($end === false ? substr($markdown, $start) : substr($markdown, $start, $end - $start));
}

/**
 * Replaces the first occurrence of $search, or stops the release if it is missing.
 */
function replaceFirst(string $subject, string $search, string $replace, string $file): string
{
    $position = strpos($subject, $search);
    if ($position === false) {
        fail(sprintf('"%s" not found in %s', trim($search), $file));
    }

    return substr_replace($subject, $replace, $position, strlen($search));
}

/**
 * Appends a line to a file provided by GitHub Actions, when the script runs there.
 */
function appendToGithubFile(string $variable, string $line): void
{
    $file = getenv($variable);
    if ($file !== false && $file !== '') {
        file_put_contents($file, $line . PHP_EOL, FILE_APPEND);
    }
}

$bump = $argv[1] ?? '';

exec("git tag --list '[0-9]*.[0-9]*.[0-9]*' --sort=-v:refname", $tags);
$latest = $tags[0] ?? '0.0.0';
[$major, $minor, $patch] = array_map('intval', explode('.', $latest));

$version = match ($bump) {
    'major' => ($major + 1) . '.0.0',
    'minor' => $major . '.' . ($minor + 1) . '.0',
    'patch' => $major . '.' . $minor . '.' . ($patch + 1),
    default => fail("Unknown bump \"$bump\", expected patch, minor or major"),
};

$changelog = file_get_contents(CHANGELOG);
if (sectionContent($changelog, '## [Unreleased]') === '') {
    fail('Nothing to release: the Unreleased section of CHANGELOG.md is empty');
}

$upgrading = is_file(UPGRADING) ? file_get_contents(UPGRADING) : '';
$hasBreakingChanges = sectionContent($upgrading, '## Unreleased') !== '';

if ($hasBreakingChanges) {
    $requiredBump = $major === 0 ? 'minor' : 'major';

    if ($bump === 'patch' || ($requiredBump === 'major' && $bump !== 'major')) {
        fail("UPGRADING.md documents breaking changes under Unreleased: a $requiredBump release is required");
    }
}

$changelog = replaceFirst(
    $changelog,
    "\n## [Unreleased]\n\n",
    "\n## [Unreleased]\n\n## [$version] - " . gmdate('Y-m-d') . "\n\n",
    CHANGELOG
);

$changelog = preg_replace_callback(
    '#^\[unreleased\]: (\S+)/compare/\S+\.\.\.HEAD$#mi',
    static fn (array $match): string => "[Unreleased]: $match[1]/compare/$version...HEAD\n"
        . "[$version]: $match[1]/compare/$latest...$version",
    $changelog,
    1,
    $count
);

if ($count !== 1) {
    fail('"[Unreleased]" comparison link not found in ' . CHANGELOG);
}

file_put_contents(CHANGELOG, $changelog);

if ($hasBreakingChanges) {
    $from = "$major.$minor";
    $to = substr($version, 0, strrpos($version, '.'));

    file_put_contents(UPGRADING, replaceFirst(
        $upgrading,
        "\n## Unreleased\n\n",
        "\n## Unreleased\n\n## $from to $to\n\n",
        UPGRADING
    ));
}

$summary = "Releasing $version (previous version: $latest)"
    . ($hasBreakingChanges ? ', with breaking changes documented in UPGRADING.md' : '');

echo $summary . PHP_EOL;
appendToGithubFile('GITHUB_STEP_SUMMARY', $summary);
appendToGithubFile('GITHUB_OUTPUT', "version=$version");
