<?php

namespace PhpOffice\PhpSpreadsheet\Calculation;

/**
 * PARTLY BASED ON:
 * Copyright (c) 2007 E. W. Bachtal, Inc.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * The software is provided "as is", without warranty of any kind, express or implied, including but not
 * limited to the warranties of merchantability, fitness for a particular purpose and noninfringement. In
 * no event shall the authors or copyright holders be liable for any claim, damages or other liability,
 * whether in an action of contract, tort or otherwise, arising from, out of or in connection with the
 * software or the use or other dealings in the software.
 *
 * http://ewbi.blogs.com/develops/2007/03/excel_formula_p.html
 * http://ewbi.blogs.com/develops/2004/12/excel_formula_p.html
 */
class FormulaToken
{
    // Token types
    public const TOKEN_TYPE_NOOP = 'Noop';
    public const TOKEN_TYPE_OPERAND = 'Operand';
    public const TOKEN_TYPE_FUNCTION = 'Function';
    public const TOKEN_TYPE_SUBEXPRESSION = 'Subexpression';
    public const TOKEN_TYPE_ARGUMENT = 'Argument';
    public const TOKEN_TYPE_OPERATORPREFIX = 'OperatorPrefix';
    public const TOKEN_TYPE_OPERATORINFIX = 'OperatorInfix';
    public const TOKEN_TYPE_OPERATORPOSTFIX = 'OperatorPostfix';
    public const TOKEN_TYPE_WHITESPACE = 'Whitespace';
    public const TOKEN_TYPE_UNKNOWN = 'Unknown';

    // Token subtypes
    public const TOKEN_SUBTYPE_NOTHING = 'Nothing';
    public const TOKEN_SUBTYPE_START = 'Start';
    public const TOKEN_SUBTYPE_STOP = 'Stop';
    public const TOKEN_SUBTYPE_TEXT = 'Text';
    public const TOKEN_SUBTYPE_NUMBER = 'Number';
    public const TOKEN_SUBTYPE_LOGICAL = 'Logical';
    public const TOKEN_SUBTYPE_ERROR = 'Error';
    public const TOKEN_SUBTYPE_RANGE = 'Range';
    public const TOKEN_SUBTYPE_MATH = 'Math';
    public const TOKEN_SUBTYPE_CONCATENATION = 'Concatenation';
    public const TOKEN_SUBTYPE_INTERSECTION = 'Intersection';
    public const TOKEN_SUBTYPE_UNION = 'Union';

    /**
     * Value.
     *
     * @var string
     */
    private $value;

    /**
     * Token Type (represented by TOKEN_TYPE_*).
     *
     * @var string
     */
    private $tokenType;

    /**
     * Token SubType (represented by TOKEN_SUBTYPE_*).
     *
     * @var string
     */
    private $tokenSubType;

    /**
     * Create a new FormulaToken.
     *
     * @param string $pValue
     * @param string $pTokenType Token type (represented by TOKEN_TYPE_*)
     * @param string $pTokenSubType Token Subtype (represented by TOKEN_SUBTYPE_*)
     */
    public function __construct($pValue, $pTokenType = self::TOKEN_TYPE_UNKNOWN, $pTokenSubType = self::TOKEN_SUBTYPE_NOTHING)
    {
        // Initialise values
        $this->value = $pValue;
        $this->tokenType = $pTokenType;
        $this->tokenSubType = $pTokenSubType;
    }

    /**
     * Get Value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set Value.
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get Token Type (represented by TOKEN_TYPE_*).
     *
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * Set Token Type (represented by TOKEN_TYPE_*).
     *
     * @param string $value
     */
    public function setTokenType($value)
    {
        $this->tokenType = $value;
    }

    /**
     * Get Token SubType (represented by TOKEN_SUBTYPE_*).
     *
     * @return string
     */
    public function getTokenSubType()
    {
        return $this->tokenSubType;
    }

    /**
     * Set Token SubType (represented by TOKEN_SUBTYPE_*).
     *
     * @param string $value
     */
    public function setTokenSubType($value)
    {
        $this->tokenSubType = $value;
    }
}
