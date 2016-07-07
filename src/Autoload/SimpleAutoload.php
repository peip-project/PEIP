<?php

namespace PEIP\Autoload;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * SimpleAutoload
 * Class providing basic autoload features.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 */
class SimpleAutoload
{
    protected $baseDir = null,
        $classPaths = [];

    protected static $instance;

    /**
     * Constructor.
     */
    protected function __construct()
    {
        $this->init();
    }

    /**
     * Initialization method.
     * Registers autoload with this class.
     */
    protected function init()
    {
        $this->baseDir = self::getBaseDirectory();
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        if (false === spl_autoload_register([$this, 'autoload'])) {
            throw new \RuntimeException(sprintf('Unable to register %s::autoload as an autoloading method.', get_class($this)));
        }
    }

    /**
     * returns the autoload base directory.
     * Registers autoload with this class.
     *
     * @return string the base directory
     */
    protected static function getBaseDirectory()
    {
        return str_replace(DIRECTORY_SEPARATOR, '/', realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'));
    }

    /**
     * Retrieves Singleton instance.
     *
     * @static
     *
     * @return SimpleAutoload
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Retrieves Singleton instance
     * To be overwritten by subclasses.
     *
     * @return SimpleAutoload
     */
    protected static function doGetInstance()
    {
        return self::$instance = new self();
    }

    /**
     * Sets a single file-path for a class.
     *
     * @param string $class the class name
     * @param string $path  the path to the class-file
     *
     * @return void
     */
    public function setClassPath($class, $path)
    {
        $this->classPaths[$class] = $path;
    }

    /**
     * Sets all class-paths as key(class)/value(path) pairs array.
     *
     * @param array $classPaths class-paths as key(class)/value(path) pairs array
     *
     * @return void
     */
    public function setClassPaths(array $classPaths)
    {
        $this->classPaths = $classPaths;
    }

    /**
     * adds class-paths as key(class)/value(path) pairs array.
     *
     * @param array $classPaths class-paths as key(class)/value(path) pairs array
     *
     * @return void
     */
    public function addClassPaths(array $classPaths)
    {
        $this->classPaths = array_merge($this->classPaths, $classPaths);
    }

    /**
     * returns the path to a class-file (if registered).
     *
     * @param string $class the class name
     *
     * @return path to the class-file
     */
    public function getClassPath($class)
    {
        if (!isset($this->classPaths[$class])) {
            return;
        }
        $file = $this->classPaths[$class];
        if (!is_file($file)) {
            $file = $this->baseDir.DIRECTORY_SEPARATOR.$file;
        }

        return $file;
    }

    /**
     * handles the autoloading of classes.
     *
     * @param string $class the class to load
     *
     * @return path to the class-file
     */
    public function autoload($class)
    {
        $path = str_replace('PEIP\\', '', $class);
        $path = $this->baseDir.'/'.str_replace('\\', '/', $path).'.php';
    //$path = $this->getClassPath($class);
        if (is_file($path)) {
            require $path;
            if (class_exists($class) || interface_exists($class)) {
                return true;
            }
        }

        return false;
    }
}
