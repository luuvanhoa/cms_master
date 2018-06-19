<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\CategoryArticle;
use App\Helpers\Images;
use App\Http\Requests\Request;
use App\Http\Models\Nested;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryArticleRequest;
use Illuminate\Support\Facades\DB;

class CategoryArticleController extends Controller
{
    protected $_nestedCategoryProduct = null;
    protected $_nestedCategoryArticle = null;

    protected $_modelCategoryProduct = null;
    protected $_modelCategoryArticle = null;

    public function __construct()
    {
        $this->_modelCategoryArticle = new CategoryArticle();
        $this->_nestedCategoryArticle = new Nested(array(
            'table' => 'category_article',
            'model' => 'CategoryArticle'
        ));
    }

    /**
     * @return $this
     */
    public function articleIndex()
    {
        $categories = DB::table($this->_modelCategoryArticle->table)->where('left', '>', 0)->orderBy('left', 'ASC')->get();
        return view('admin.category-article.index')->with(compact('categories'));
    }

    /**
     * @return $this
     */
    public function articleAdd()
    {
        $listCategories = DB::table($this->_modelCategoryArticle->table)->where('left', '>', 0)->orderBy('left', 'ASC')->get();
        $categories = [];
        $categories['1000000'] = 'Danh mục cha';
        if (!empty($listCategories)) {
            foreach ($listCategories as $category) {
                $space = str_repeat('|——', $category->level - 1);
                $categories[$category->id] = $space . $category->name;
            }
        }
        return view('admin.category-article.form-category')->with(compact('categories'));
    }

    /**
     * @param Request $request
     */
    public function articleChangeStatus(Request $request)
    {
        $id = $request->get('id');
        $status = $request->get('status');
        $category = $this->findById($this->_modelCategoryArticle, $id);
        $category->status = $status;
        $category->save();
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function articlePost(CategoryArticleRequest $request)
    {
        $data = $this->_modelCategoryArticle->mapsDataDefault($request->all());
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $data['image'] = Images::createImage($image);
        }

        $parent = intval($request->get('parent'));
        if ($parent > 0) {
            $this->_nestedCategoryArticle->insertNode($data, $parent, array('position' => 'right'));
        }

        return redirect(route('article-category'));
    }

    /**
     * @param $id
     * @return $this
     */
    public function articleEdit($id)
    {
        $category = $this->findById($this->_modelCategoryArticle, $id);
        $categories = DB::table($this->_modelCategoryArticle->table)
            ->where('left', '>', 0)
            ->orderBy('left', 'ASC')->get();

        return view('admin.category-article.edit-category')->with(compact('category', 'categories'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function articleStore($id, Request $request)
    {
        $data = $this->_modelCategoryArticle->mapsDataDefault($request->all());
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $data['image'] = Images::createImage($image);
        }
        if (isset($data['parent']) && $data['parent'] == $id) {
            $data['parent'] = null;
        }
        $data['modified_time'] = date('Y-m-d H:i:s');
        $this->updateNodeCategoryArticle($data, $id, $data['parent']);
        return redirect(route('article-category'));
    }

    protected function updateNodeCategoryArticle($data, $nodeID, $nodeParentID = null)
    {
        if (!empty($nodeParentID)) {
            $nodeParentInfo = $this->findById($this->_modelCategoryArticle, $nodeParentID);
            $nodeInfo = $this->findById($this->_modelCategoryArticle, $nodeID);
            if (!empty($nodeParentInfo) && $nodeInfo->parent != $nodeParentInfo->id) {
                $this->_nestedCategoryArticle->moveRight($nodeID, $nodeParentID);
            }
        }

        $dataUpdate = array();
        foreach ($data as $k => $v) {
            if ($v != null) {
                $dataUpdate[$k] = $v;
            }
        }

        DB::table($this->_modelCategoryArticle->table)
            ->where('id', $nodeID)
            ->update($dataUpdate);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function articleDelete($id)
    {
        $category = $this->findById($this->_modelCategoryArticle, $id);
        Images::deleteImage($category->path);
        $nodes = DB::table('categories')->where('parent', $id)->orderBy('left', 'ASC')->get();

        if (!empty($nodes)) {
            foreach ($nodes as $node) {
                $this->_nestedCategoryArticle->moveRight($node->id, $category->parent);
            }
        }
        $this->_nestedCategoryArticle->detachBranch($id, array('task' => 'remove-node'));

        return redirect('/admin/category');
    }
}
