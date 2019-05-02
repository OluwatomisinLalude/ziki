<?php
namespace Ziki\Core;
/**
 *	A Collection object represents a set of Document objects (matching certain criterias).
 *
 */
class Collection
{
    protected $dir;
    
    protected $entries;

    public function __construct($dir, $entries)
    {
        $this->dir     = $dir;
        $this->entries = $entries;
    }
}
