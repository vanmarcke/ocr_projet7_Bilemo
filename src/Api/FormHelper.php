<?php

namespace App\Api;

use Symfony\Component\Form\Form;

class FormHelper
{
    /**
     * Method getErrors.
     *
     * @param Form $form Form processing
     */
    public static function getErrors(Form $form): array
    {
        $errors = [];

        foreach ($form->all() as $field) {
            $fieldKey = $field->getName();
            foreach ($field->getErrors(true) as $error) {
                if (array_key_exists($fieldKey, $errors)) {
                    $errors[$fieldKey][] = $error->getMessage();
                } else {
                    $errors[$fieldKey] = [$error->getMessage()];
                }
            }
        }

        return $errors;
    }

    /**
     * Method checkFields.
     *
     * @param null|array $data Contains error data
     */
    public static function checkFields(array $data): ?array
    {
        foreach ($data as $key => $field) {
            if (empty($field)) {
                return ['error' => "The field '$key' cannot be set to null, don't set it if you want to keep the previous value"];
            }
        }

        return null;
    }
}
