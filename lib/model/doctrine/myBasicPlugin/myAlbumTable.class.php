<?php

/**
 * myAlbumTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class myAlbumTable extends PluginmyAlbumTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object myAlbumTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('myAlbum');
    }
}