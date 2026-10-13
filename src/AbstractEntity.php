<?php

namespace ArrowSphere\PublicApiClient;

use ArrowSphere\PublicApiClient\Exception\EntityValidationException;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

/**
 * Class AbstractEntity
 *
 * @deprecated No entity of the library extends this class anymore: extend Entities\AbstractEntity, which hydrates and
 *             serializes the entities from their #[Property] attributes. This class, its validation and the
 *             illuminate/validation dependency will be removed in version 1.0.
 */
abstract class AbstractEntity implements \JsonSerializable
{
    /**
     * @var array<string, mixed>
     *
     * @deprecated will be removed with this class in version 1.0
     */
    protected const VALIDATION_RULES = [];

    /**
     * @var array<string, string>
     *
     * @deprecated will be removed with this class in version 1.0
     */
    protected const VALIDATION_MESSAGES = [];

    /**
     * @var bool Whether the validation is enabled or not.
     *
     * @deprecated will be removed with this class in version 1.0, with the checks it enables
     */
    public static $enableValidation = false;

    /**
     * AbstractEntity constructor.
     *
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function __construct(array $data)
    {
        $this->validate($data);
    }

    /**
     * @param array $data
     *
     * @throws EntityValidationException
     */
    public function validate(array $data): void
    {
        // If the validation has been disabled, stop
        if (! self::$enableValidation) {
            return;
        }

        // If we don't have illuminate classes for validation, forget about validation
        if (! class_exists(Factory::class) || ! class_exists(Translator::class) || ! class_exists(ArrayLoader::class)) {
            return;
        }

        $factory = (new Factory(
            new Translator(
                new ArrayLoader(),
                'en'
            )
        ));

        $messages = array_merge(
            [
                'required_if' => ':attribute is required if :other is equal to :value',
                'required' => ':attribute is required',
                'present'  => ':attribute is required',
                'array'    => ':attribute must be an array',
                'numeric'  => ':attribute must be a number',
                'string'   => ':attribute must be a string',
                'boolean'  => ':attribute must be a boolean',
            ],
            static::VALIDATION_MESSAGES
        );

        $validator = $factory->make($data, static::VALIDATION_RULES, $messages);

        if (! $validator->passes()) {
            /** @var string[] $errors */
            $errors = $validator->getMessageBag()->all();

            throw new EntityValidationException(implode('; ', $errors));
        }
    }
}
