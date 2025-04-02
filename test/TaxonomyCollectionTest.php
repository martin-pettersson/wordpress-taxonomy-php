<?php

/*
 * Copyright (c) 2025 Martin Pettersson
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace N7e\WordPress;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(TaxonomyCollection::class)]
final class TaxonomyCollectionTest extends TestCase
{
    private TaxonomyCollection $collection;

    #[Before]
    public function setUp(): void
    {
        $this->collection = new TaxonomyCollection();
    }

    #[Test]
    public function shouldBeEmptyByDefault(): void
    {
        $this->assertEmpty($this->collection->getIterator());
    }

    #[Test]
    public function shouldAddEntry(): void
    {
        $taxonomyMock = $this->getMockBuilder(Taxonomy::class)->getMock();

        $this->collection->add($taxonomyMock);

        $this->assertCount(1, $this->collection->getIterator());

        foreach ($this->collection as $entry) {
            $this->assertSame($taxonomyMock, $entry);
        }
    }
}
