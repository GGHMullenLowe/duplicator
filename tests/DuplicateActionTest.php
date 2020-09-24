<?php

namespace DoubleThreeDigital\Duplicator\Tests;

use DoubleThreeDigital\Duplicator\DuplicateAction;
use Illuminate\Support\Facades\Config;
use Statamic\Facades\Entry;
use Statamic\Facades\Site;
use Statamic\Sites\Sites;

class DuplicateActionTest extends TestCase
{
    public $user;
    public $action;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->makeStandardUser();
        $this->action = new DuplicateAction();
    }

    /** @test */
    public function cant_get_field_items_for_single_site()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function can_get_field_items_for_multi_site()
    {
        $this->markTestIncomplete();
    }

    /** @test */
    public function is_visible_for_entries()
    {
        $collection = $this->makeCollection('articles', 'Articles');
        $entry = $this->makeEntry('articles', 'fresh-article', $this->user);

        $visible = $this->action->visibleTo($entry);

        $this->assertTrue($visible);
    }

    /** @test */
    public function is_not_visible_for_non_entries()
    {
        $collection = $this->makeCollection('gallery', 'Photo Gallery');

        $visible = $this->action->visibleTo($collection);

        $this->assertFalse($visible);
    }

    /** @test */
    public function can_duplicate_entry()
    {
        $collection = $this->makeCollection('guides', 'Guides');
        $entry = $this->makeEntry('guides', 'fresh-guide', $this->user);

        $duplicate = $this->action->run(collect([$entry]), []);

        $duplicateEntry = Entry::findBySlug('fresh-guide-duplicate', 'guides');

        $this->assertIsObject($duplicateEntry);
        $this->assertSame($duplicateEntry->slug(), 'fresh-guide-duplicate');
    }

    /** @test */
    public function can_duplicate_entry_for_different_site()
    {
        $this->markTestIncomplete();
    }
}
