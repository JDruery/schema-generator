<?php

/*
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace SchemaOrgModel\AnnotationGenerator;

/**
 * Constraint annotation generator
 *
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class ConstraintAnnotationGenerator extends AbstractAnnotationGenerator
{

    /**
     * {@inheritdoc}
     */
    public function generateClassAnnotations($className)
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function generateFieldAnnotations($className, $fieldName, $range)
    {
        switch ($range) {
            case 'URL':
                return ['@Assert\Url'];

            case 'Date':
                return ['@Assert\Date'];

            case 'DateTime':
                return ['@Assert\DateTime'];

            case 'Time':
                return ['@Assert\Time'];
        }

        if ('email' === $fieldName) {
            return ['@Assert\Email'];
        }

        $phpType = PhpDocAnnotationGenerator::toPhpType($range);
        if (in_array($phpType, ['boolean', 'float', 'integer', 'string'])) {
            return [sprintf('@Assert\Type(type="%s")', $phpType)];
        }

        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function generateUses($className)
    {
        return ['use Symfony\Component\Validator\Constraints as Assert;'];
    }
}