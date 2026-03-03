# AGENTS.md — ArrowSphere Public API Client

PHP 8.0+ library (`arrowsphere/public-api-client`) providing a Guzzle-based client for
ArrowSphere's public REST API. Namespace root: `ArrowSphere\PublicApiClient\` → `src/`.

---

## Commands

### Tests

```bash
# Run the full test suite
vendor/bin/phpunit

# Run a single test file
vendor/bin/phpunit tests/General/WhoamiClientTest.php

# Run a single test method
vendor/bin/phpunit --filter testGetWhoami tests/General/WhoamiClientTest.php

# Run with code coverage (outputs to build/artifacts/coverage/)
make coverage
```

### Static analysis and code style

PHPStan, Psalm, and php-cs-fixer run via Docker (requires Docker daemon).

```bash
# Run all static checks (phpstan + psalm + cs-fixer dry-run)
make static

# Code style: check only (dry-run)
make static-codestyle-check

# Code style: apply fixes
make static-codestyle-fix

# PHPStan only (max level, paths: src/)
make static-phpstan

# Psalm only (level 3)
make static-psalm

# Regenerate baselines after intentional suppressions
make static-phpstan-update-baseline
make static-psalm-update-baseline
```

---

## Code Style

Enforced by **php-cs-fixer** (`@PSR2` base). Key rules:

- **No `declare(strict_types=1)`** — explicitly disabled; do not add it.
- **Short array syntax** `[]` everywhere; no trailing comma in single-line arrays.
- **Imports**: alphabetically ordered (`ordered_imports`), no leading slash, no unused imports.
  Use fully-qualified types (`fully_qualified_strict_types`); never use unqualified class names
  without an `use` statement.
- **Strings**: concatenation operator `.` surrounded by single spaces.
- **No yoda conditions**: `$x === null`, not `null === $x`.
- **Compact nullable typehints**: `?string`, not `? string`.
- **No extra blank lines**; one blank line between class methods
  (`class_attributes_separation`).
- **Ternary to null-coalescing**: prefer `$a ?? $b` over `$a !== null ? $a : $b`.
- **Self static accessor**: use `self::` inside a class instead of the class name.
- **No useless `else`** after a `return`/`throw`; no useless `return` at end of void methods.

### PHPDoc

PHPDoc is **required** on every property and every method (multi-line style enforced by
`phpdoc_line_span`):

```php
/**
 * @var string
 */
private string $foo;

/**
 * Does something useful.
 *
 * @param string $bar
 *
 * @return string
 *
 * @throws PublicApiClientException
 */
public function doSomething(string $bar): string
```

- Every exception that can propagate out of a method **must** appear in a `@throws` tag.
- `null` always last in union types: `string|null`, not `null|string`.
- Use scalar types in PHPDoc (`bool`, `int`, `float`, `string`), not `boolean`/`integer`.
- No `@package` tags (`phpdoc_no_package`).

### Naming

- **Classes / Interfaces / Traits**: `PascalCase`.
- **Methods / properties / variables**: `camelCase`.
- **Constants**: `UPPER_SNAKE_CASE`. Entity field/API key names are stored as `COLUMN_*`
  constants on the entity class (e.g. `COLUMN_COMPANY_NAME = 'companyName'`).
- **Enum-style classes** extend `AbstractEnum`; use class constants for values.
- **Test classes**: suffix `Test` (e.g. `WhoamiClientTest`). Test methods are prefixed
  `test` (no `@test` annotation).

---

## Architecture Conventions

### Clients

- All sub-clients extend `AbstractClient` (or a domain abstract extending it).
- **Two-method pattern** per endpoint:
  - `getFooRaw(): string` — sets `$this->path`, calls `$this->get()`, returns raw JSON string.
  - `getFoo(): Entity` — calls `getFooRaw()`, decodes, returns a typed entity.
- **Paginated list endpoints** return a `Generator` via `yield` inside a page loop.
- Fluent setters always return `self` (or `static`).
- Set `$this->path` at the start of each client method, not in the constructor.

### Entities (two systems — both in use)

**Legacy** (`src/AbstractEntity.php`):
- Constructor receives `array $data`.
- Field name constants: `COLUMN_FOO = 'foo'` on the entity class.
- Getters read from `$this->data[static::COLUMN_FOO]`.
- Validation via `illuminate/validation` is **disabled by default** (`$enableValidation =
  false`); it is enabled only in tests via `setUp()`.

**Newer** (`src/Entities/AbstractEntity.php`):
- PHP 8 `#[Property]` attribute on constructor parameters.
- Reflection-based auto-hydration from the input array.
- Getters read from typed properties.
- ALWAYS USE NEWER STYLE FOR NEW ENTITIES; legacy style is only for existing entities that haven't been migrated yet.

### Exceptions

- `PublicApiClientException` — base; thrown on HTTP 4xx/5xx or JSON decode failure.
- `NotFoundException` — thrown specifically on HTTP 404.
- `EntityValidationException` — thrown when legacy entity validation fails.

---

## Testing Conventions

- All test classes extend `AbstractClientTest`.
- Declare `protected const MOCKED_CLIENT_CLASS = YourClient::class;`.
- `GuzzleHttp\Client` is mocked via `$this->createMock(Client::class)`; the mock is
  available as `$this->httpClient`.
- **Triple test pattern** per endpoint (use `@depends` to chain them):
  1. `testGetFooRaw` — verify URL and HTTP method called.
  2. `testGetFooWithInvalidResponse` — assert `PublicApiClientException` is thrown on bad JSON.
  3. `testGetFoo` — full test with inline JSON heredoc fixture; assert entity getters.
- **Use `self::`** for all assertions and mock expectations (`self::assertEquals`,
  `self::once()`, etc.) — never `$this->assert*`.
- JSON fixtures go as **heredoc strings** directly inside the test method body.
- Do not change `AbstractEntity::$enableValidation`; it is set to `true` in
  `AbstractClientTest::setUp()`.

---

## Changelog

The project follows [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) and
[Semantic Versioning](https://semver.org/spec/v2.0.0.html).

**Every code change must be recorded under `## [Unreleased]`** at the top of
`CHANGELOG.md`, before the first versioned section. Entries use bullet points; no
sub-sections are required for minor/patch releases (most existing entries do not use them),
but the canonical sub-section labels are `### Added`, `### Changed`, `### Fixed`,
`### Deprecated`, and `### Removed` — use them for larger releases or when clarity
benefits from grouping.

Entry wording conventions observed in this repo:

- **Added**: start with `Added …` — new client, method, property, entity, or behaviour.
  Name the `method` under `class` explicitly: `Added new method \`postExport()\` under \`CustomersClient\``.
- **Changed**: start with `Changed …` or `Updated …` — modifications to existing
  signatures, renamed symbols, updated dependencies.
- **Fixed**: start with `Fixed …` — bug fixes; include the class/method name.
- **Deprecated**: start with `Deprecated …`; state the replacement in the same sentence.
- **Removed**: start with `Removed …`; note the replacement if one exists.
