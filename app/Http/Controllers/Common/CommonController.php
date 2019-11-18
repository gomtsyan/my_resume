<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class CommonController extends Controller
{
    /**
     * Config Key for template.
     *
     * @var string $template
     */
    protected $configKey;

    /**
     * Page template.
     *
     * @var string $template
     */
    protected $template;

    /**
     * Page content.
     *
     * @var
     */
    protected $content;

    /**
     * Array for variables passed to views.
     *
     * @var array $vars
     */
    protected $vars = array();

    /**
     * @return $this
     */
    protected function renderCurrentView()
    {
        if ($this->contentExist()) {
            $this->addContentToPage();
        }

        return view($this->template)->with($this->vars);
    }

    /**
     * @return bool
     */
    protected function contentExist()
    {
        return $this->content ? true : false;
    }

    /**
     * Adding content to page
     */
    protected function addContentToPage()
    {
        $this->varsPush('content', $this->content);
    }

    /**
     * @param $view
     * @param array $with
     * @return array|bool|string
     */
    protected function getViewContent($view, $with = array())
    {
        if (blank($view)) {
            return false;
        }

        $content = view(config('settings.' . $this->configKey) . '.' . $view);

        if ($with) {
            $content->with($with);
        }

        return $content->render();
    }

    /**
     * Vars push - add an element ([$key => $value]) to $this->vars array
     * (using add method in helper Arr) and return it.
     *
     * @param $key
     * @param $value
     * @return array
     */
    protected function varsPush($key, $value)
    {
        $this->vars = Arr::add($this->vars, $key, $value);

        return $this->vars;
    }
}
