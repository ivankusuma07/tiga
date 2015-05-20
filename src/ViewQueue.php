<?php

namespace Tiga\Framework;

class ViewQueue {
	
	protected $template;
	protected $parameter;

	public function __construct($template,$parameter){

		$this->template = $template;
		$this->parameter = $parameter;

	}

    /**
     * Gets the value of template.
     *
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Sets the value of template.
     *
     * @param mixed $template the template
     *
     * @return self
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Gets the value of parameter.
     *
     * @return mixed
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets the value of parameter.
     *
     * @param mixed $parameter the parameter
     *
     * @return self
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;

        return $this;
    }
}