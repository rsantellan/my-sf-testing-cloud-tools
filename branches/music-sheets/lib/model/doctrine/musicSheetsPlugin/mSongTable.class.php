<?php

/**
 * mSongTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class mSongTable extends PluginmSongTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object mSongTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('mSong');
    }
}