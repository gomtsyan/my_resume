<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Common\CommonController;
use App\Repositories\Contracts\ContactMeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminController extends CommonController
{
    /**
     * @var $title
     */
    protected $title;

    /**
     * @var $subTitle
     */
    protected $subTitle;

    /**
     * @var $redirectPath
     */
    protected $redirectPath;

    /**
     * @var ContactMeRepository
     */
    protected $contactMeRepo;

    /**
     * @var $searchRepo
     */
    protected $searchRepo;

    /**
     * @var $searchView
     */
    protected $searchView;


    /**
     * Subtracting the following fields from the Fields array.
     *
     * @var array
     */
    protected $exceptFields = [];


    /**
     * AdminController constructor.
     * @param ContactMeRepository $contactMeRepo
     */
    public function __construct(ContactMeRepository $contactMeRepo)
    {
        $this->contactMeRepo = $contactMeRepo;
        $this->configKey = 'admin_theme';
    }

    /**
     * @return CommonController
     */
    protected function renderCurrentView()
    {
        if ($this->titleExist()) {
            $this->definePageTitle();
        }

        $this->addSideBarToPage();
        $this->addPageHeaderToPage();

        return parent::renderCurrentView();
    }

    /**
     * Define page title.
     */
    protected function definePageTitle()
    {
        $this->varsPush('title', $this->title);
    }

    /**
     * Add left side bar to page
     */
    protected function addSideBarToPage()
    {
        $menu = $this->getSideBarMenu();
        $sideBar = $this->getViewContent('partials.side_bar', ['menu' => $menu]);
        $this->varsPush('sideBar', $sideBar);
    }

    /**
     * Add page header to page.
     */
    protected function addPageHeaderToPage()
    {
        if (!$this->isMessagesPage()) {
            $messages = $this->getLatestMessages();
            $unreadMessagesCount = $this->getUnreadMessagesCount();
        }

        $pageHeader = $this->getViewContent('partials.page_header',
            [
                'title' => $this->title,
                'subTitle' => $this->subTitle,
                'messages' => $messages ?? null,
                'unreadMessagesCount' => $unreadMessagesCount ?? null
            ]
        );

        $this->varsPush('pageHeader', $pageHeader);
    }

    /**
     * Get not viewed messages.
     *
     * @return mixed
     */
    protected function getLatestMessages()
    {
        return $this->contactMeRepo->take(config('settings.admin_latest_messages_count'));
    }

    /**
     * Get unread messages count.
     *
     * @return mixed
     */
    protected function getUnreadMessagesCount()
    {
        return $this->contactMeRepo->getCountBy('is_viewed', '0');
    }

    /**
     * Get field names for show in content page.
     *
     * @param $dataObject
     * @return array
     */
    protected function getFieldNames($dataObject)
    {
        if($dataObject->first()){
            $dataArray = Arr::except($dataObject->first()->toArray(), $this->exceptFields);

            if (is_array($dataArray)) {
                $fieldNames = array_keys($dataArray);

                return $fieldNames;
            }
        }

        return [];
    }

    /**
     * @param $data
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function getFormSelectData($data, $value, $key = 'id')
    {
        return $data->reduce(function ($returnData, $item) use ($key, $value) {

            if (!isset($item->$key)) {
                return [];
            }

            $returnData[$item->$key] = $item->$value ?? '';

            return $returnData;

        }, []);
    }

    /**
     * Build sidebar menu.
     *
     * @return mixed
     */
    private function getSideBarMenu()
    {
        $pages = $this->getPages();

        $menuBuilder = \Menu::make('SideBarMenu', function ($menu) use ($pages) {

            foreach ($pages as $key => $page) {
                if ($page['parent_id'] == 0) {
                    if ($page['model']) {
                        if (auth()->user()->can('viewAny', $page['model'])) {
                            $menu
                                ->add($page['name'], ['route' => $page['route']])
                                ->data(['icon' => $page['icon'], 'controllers' => $page['controllers']])
                                ->id($page['id']);
                        }
                    } else {
                        $menu
                            ->add($page['name'], $page['route'] ? ['route' => $page['route']] : 'javascript:void(0)')
                            ->data(['icon' => $page['icon'], 'controllers' => $page['controllers']])
                            ->id($page['id']);
                    }
                } else {
                    if ($menu->find($page['parent_id'])) {
                        if ($page['model']) {
                            if (auth()->user()->can('viewAny', $page['model'])) {
                                $menu
                                    ->find($page['parent_id'])
                                    ->add($page['name'],
                                        $page['route'] ? ['route' => $page['route']] : 'javascript:void(0)')
                                    ->data(['icon' => $page['icon'], 'controllers' => $page['controllers']])
                                    ->id($page['id']);
                            }
                        } else {
                            $menu
                                ->find($page['parent_id'])
                                ->add($page['name'],
                                    $page['route'] ? ['route' => $page['route']] : 'javascript:void(0)')
                                ->data(['icon' => $page['icon'], 'controllers' => $page['controllers']])
                                ->id($page['id']);
                        }
                    }
                }
            }
        });

        return $menuBuilder;
    }

    /**
     * @return array
     */
    private function getPages()
    {
        return [
            [
                'id' => 1,
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'fa fa-home',
                'model' => '',
                'controllers' => ['IndexController'],
                'parent_id' => 0
            ],
            [
                'id' => 2,
                'name' => 'Profile',
                'route' => 'profile.index',
                'icon' => 'fas fa-id-card-alt',
                'model' => 'App\Models\AboutMe',
                'controllers' => ['ProfileController'],
                'parent_id' => 0
            ],
            [
                'id' => 3,
                'name' => 'Portfolio',
                'route' => 'portfolio.index',
                'icon' => 'fas fa-briefcase',
                'model' => 'App\Models\Portfolio',
                'controllers' => ['PortfolioController'],
                'parent_id' => 0
            ],
            [
                'id' => 19,
                'name' => 'Resume',
                'route' => '',
                'icon' => 'fas fa-clipboard',
                'model' => '',
                'controllers' => [
                    'ExperienceController',
                    'EducationController',
                    'PersonalInfoController'
                ],
                'parent_id' => 0
            ],
            [
                'id' => 5,
                'name' => 'Experience',
                'route' => 'experiences.index',
                'icon' => 'fas fa-laptop-code',
                'model' => 'App\Models\Experience',
                'controllers' => ['ExperienceController'],
                'parent_id' => 19
            ],
            [
                'id' => 6,
                'name' => 'Education',
                'route' => 'education.index',
                'icon' => 'fas fa-graduation-cap',
                'model' => 'App\Models\Education',
                'controllers' => ['EducationController'],
                'parent_id' => 19
            ],
            [
                'id' => 14,
                'name' => 'Personal Info',
                'route' => 'personal.index',
                'icon' => 'fas fa-info-circle',
                'model' => 'App\Models\PersonalInfo',
                'controllers' => ['PersonalInfoController'],
                'parent_id' => 19
            ],
            [
                'id' => 18,
                'name' => 'Skills',
                'route' => '',
                'icon' => 'fas fa-code',
                'model' => '',
                'controllers' => [
                    'LanguageSkillController',
                    'SkillController',
                    'SkillCategoryController'
                ],
                'parent_id' => 0
            ],
            [
                'id' => 7,
                'name' => 'Language Skills',
                'route' => 'languages.index',
                'icon' => 'fas fa-language',
                'model' => 'App\Models\LanguageSkill',
                'controllers' => ['LanguageSkillController'],
                'parent_id' => 18
            ],
            [
                'id' => 8,
                'name' => 'Professional Skills',
                'route' => 'skills.index',
                'icon' => 'fab fa-laravel',
                'model' => 'App\Models\Skill',
                'controllers' => ['SkillController'],
                'parent_id' => 18
            ],
            [
                'id' => 9,
                'name' => 'Skill Categories',
                'route' => 'categories.index',
                'icon' => 'fas fa-cubes',
                'model' => 'App\Models\SkillCategory',
                'controllers' => ['SkillCategoryController'],
                'parent_id' => 18
            ],
            [
                'id' => 4,
                'name' => 'Contact',
                'route' => 'contact.index',
                'icon' => 'fas fa-address-book',
                'model' => 'App\Models\Contact',
                'controllers' => ['ContactController'],
                'parent_id' => 0
            ],
            [
                'id' => 20,
                'name' => 'Blog',
                'route' => '',
                'icon' => 'fas fa-blog',
                'model' => '',
                'controllers' => [
                    'ArticleController',
                    'ArticleCategoryController'
                ],
                'parent_id' => 0
            ],
            [
                'id' => 10,
                'name' => 'Articles',
                'route' => 'blog.index',
                'icon' => 'fas fa-newspaper',
                'model' => 'App\Models\Article',
                'controllers' => ['ArticleController'],
                'parent_id' => 20
            ],
            [
                'id' => 11,
                'name' => 'Article Categories',
                'route' => 'category.index',
                'icon' => 'fas fa-boxes',
                'model' => 'App\Models\ArticleCategory',
                'controllers' => ['ArticleCategoryController'],
                'parent_id' => 20
            ],
            [
                'id' => 12,
                'name' => 'Messages',
                'route' => 'messages.index',
                'icon' => 'fas fa-envelope',
                'model' => 'App\Models\ContactMe',
                'controllers' => ['MessageController'],
                'parent_id' => 0
            ],
            [
                'id' => 21,
                'name' => 'Config',
                'route' => '',
                'icon' => 'fas fa-cogs',
                'model' => '',
                'controllers' => [
                    'UserController',
                    'PrivilegeController',
                    'PageController',
                    'SettingController',
                    'RoleController'
                ],
                'parent_id' => 0
            ],
            [
                'id' => 16,
                'name' => 'Pages',
                'route' => 'pages.index',
                'icon' => 'fas fa-th-list',
                'model' => 'App\Models\Page',
                'controllers' => ['PageController'],
                'parent_id' => 21
            ],
            [
                'id' => 13,
                'name' => 'Users',
                'route' => 'users.index',
                'icon' => 'fas fa-user-cog',
                'model' => 'App\Models\User',
                'controllers' => ['UserController'],
                'parent_id' => 21
            ],
            [
                'id' => 22,
                'name' => 'Roles',
                'route' => 'roles.index',
                'icon' => 'fas fa-users',
                'model' => 'App\Models\Role',
                'controllers' => ['RoleController'],
                'parent_id' => 21
            ],
            [
                'id' => 15,
                'name' => 'Privileges',
                'route' => 'privileges.index',
                'icon' => 'fas fa-unlock-alt',
                'model' => 'App\Models\Permission',
                'controllers' => ['PrivilegeController'],
                'parent_id' => 21
            ],
            [
                'id' => 17,
                'name' => 'Settings',
                'route' => 'settings.index',
                'icon' => 'fas fa-cogs',
                'model' => 'App\Models\Setting',
                'controllers' => ['SettingController'],
                'parent_id' => 21
            ],
            [
                'id' => 23,
                'name' => 'Analytics',
                'route' => '',
                'icon' => 'fas fa-chart-line',
                'model' => '',
                'controllers' => [
                    'VisitorController'
                ],
                'parent_id' => 0
            ],
            [
                'id' => 24,
                'name' => 'Visitors',
                'route' => 'visitors.index',
                'icon' => 'fas fa-user-tie',
                'model' => 'App\Models\Visitor',
                'controllers' => ['VisitorController'],
                'parent_id' => 23
            ],
            [
                'id' => 25,
                'name' => 'Visited Pages',
                'route' => 'analysis.index',
                'icon' => 'fas fa-chart-pie',
                'model' => 'App\Models\VisitedPage',
                'controllers' => ['VisitedPageController'],
                'parent_id' => 23
            ],
        ];
    }

    /**
     * @param $repository
     * @param $request
     * @return mixed
     */
    protected function createData($repository, $request)
    {
        return $repository->create($request);
    }

    /**
     * @param $repository
     * @param $request
     * @param $data
     * @return $this|mixed
     */
    protected function updateData($repository, $request, $data)
    {
        return $repository->update($request, $data);
    }

    /**
     * @param $repository
     * @param $data
     * @return mixed
     */
    protected function deleteData($repository, $data)
    {
        return $repository->delete($data);
    }

    /**
     * @param Request $request
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {

            $items = $this->searchRepo->search(request('keyword'));

            $itemsListContent = $this->getViewContent($this->searchView,
                [
                    'items' => $items
                ]
            );

            echo json_encode(['success' => $itemsListContent]);
            die;
        }
    }

    /**
     * @return bool
     */
    protected function titleExist()
    {
        return $this->title ? true : false;
    }

    /**
     * @param $result
     * @return bool
     */
    protected function isErrorExist($result)
    {
        return is_array($result) && !empty($result['error']);
    }

    /**
     * @return bool
     */
    protected function isMessagesPage()
    {
        return request()->route()->named('messages.index');
    }
}
