<?php

namespace PEIP\Data;

/*
 * This file is part of the PEIP package.
 * (c) 2009-2011 Timo Michna <timomichna/yahoo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * ParameterHolder
 * Class to act as a simple holder for parameters as key/value pairs.
 * Can act as a base class for classes dealing with parameters.
 *
 * @author Timo Michna <timomichna/yahoo.de>
 * @implements \PEIP\INF\Data\ParameterHolder
 */
class ParameterHolder implements \PEIP\INF\Data\ParameterHolder
{
    protected $parameters = [];

    /**
     * Checks wether a given parameter is set.
     *
     * @param string $key name of parameter
     *
     * @return bool wether parameter is set
     */
    public function hasParameter($key)
    {
        return array_key_exists($key, $this->parameters);
    }

    /**
     * returns a given parameter value.
     *
     * @param string $key name of parameter
     *
     * @return
     */
    public function getParameter($key)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : null;
    }

    /**
     * Deletes a given parameter.
     *
     * @param string $key name of parameter
     *
     * @return
     */
    public function deleteParameter($key)
    {
        unset($this->parameters[$key]);
    }

    /**
     * Sets the value for a given parameter.
     *
     * @param string $key   name of parameter
     * @param string $value value to set for the parameter
     *
     * @return
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Sets all parameters as key/value pairs.
     *
     * @param array $parameters parameters as key/value pairs
     *
     * @return
     */
    public function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * returns parameters as key/value pairs.
     *
     * @return array $parameters parameters as key/value pairs
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Adds parameters as key/value pairs.
     * Overwrites value for a parameter if allready been set.
     *
     * @param array $parameters parameters as key/value pairs
     *
     * @return
     */
    public function addParameters(array $parameters)
    {
        $this->parameters = array_merge($this->parameters, $parameters);
        array_unique($this->parameters);
    }

    /**
     * Adds parameters as key/value pairs only if parameter has not allready
     * been set.
     *
     * @param array $parameters parameters as key/value pairs
     *
     * @return
     */
    public function addParametersIfNot(array $parameters)
    {
        $this->parameters = array_merge($parameters, $this->parameters);
        array_unique($this->parameters);
    }
}
