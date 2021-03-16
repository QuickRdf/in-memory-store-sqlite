<?php

namespace sweetrdf\InMemoryStoreSqlite\Rdf;

/*
 * This file is part of the sweetrdf/InMemoryStoreSqlite package and licensed under
 * the terms of the GPL-3 license.
 *
 * (c) Konrad Abicht <hi@inspirito.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Exception;
use rdfInterface\Literal as iLiteral;
use rdfInterface\Term;
use rdfInterface\TYPE_LITERAL;
use sweetrdf\InMemoryStoreSqlite\NamespaceHelper;
use Stringable;

class Literal implements iLiteral
{
    private int | float | string | bool | Stringable $value;

    private ?string $lang;

    private ?string $datatype;

    public function __construct(
        int | float | string | bool | Stringable $value,
        ?string $lang = null,
        ?string $datatype = null
    ) {
        $this->value = $value;
        $this->lang = $lang;
        $this->datatype = $datatype;
    }

    public function __toString(): string
    {
        $langtype = '';
        if (!empty($this->lang)) {
            $langtype = '@'.$this->lang;
        } elseif (!empty($this->datatype)) {
            $langtype = "^^<$this->datatype>";
        }

        return '"'.$this->value.'"'.$langtype;
    }

    public function getValue(): int | float | string | bool | Stringable
    {
        return $this->value;
    }

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function getDatatype(): string
    {
        return $this->datatype ?? NamespaceHelper::NAMESPACE_XSD;
    }

    public function getType(): string
    {
        return TYPE_LITERAL;
    }

    public function equals(Term $term): bool
    {
        return $this === $term;
    }

    public function withValue(int | float | string | bool | Stringable $value): self
    {
        throw new Exception('withValue not implemented yet');
    }

    public function withLang(?string $lang): self
    {
        throw new Exception('withLang not implemented yet');
    }

    public function withDatatype(?string $datatype): self
    {
        throw new Exception('withDatatype not implemented yet');
    }
}
