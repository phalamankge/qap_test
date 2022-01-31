<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Product::with(['categories', 'tags'])->select(sprintf('%s.*', (new Product())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'product_show';
                $editGate = 'product_edit';
                $deleteGate = 'product_delete';
                $crudRoutePart = 'products';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('tag', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'category', 'tag', 'photo']);

            return $table->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id');

        $tags = ProductTag::pluck('name', 'id');

        return view('admin.products.create', compact('categories', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        $product->categories()->sync($request->input('categories', []));
        $product->tags()->sync($request->input('tags', []));
        if ($request->input('photo', false)) {
            $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $product->id]);
        }

        return redirect()->route('admin.products.index');
    }

    public function edit(Product $product)
    {
        abort_if(Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ProductCategory::pluck('name', 'id');

        $tags = ProductTag::pluck('name', 'id');

        $product->load('categories', 'tags');

        $title = $product->name;

        $icon = 'fa fa-arrow-right';

        $action = route('admin.products.update', [$product->id]);

        $method = 'PUT';

        $fields = array();
        $keys = array(
            'id', 'name', 'description', 'price', 'categories', 'tags',
        );
        foreach($keys as $key)
        {
            $fields[$key] = array(
                'name' => $key,
                'value' => $product->$key,
                'label' => trans("cruds.product.fields.$key"),
                'type' => 'text',
                'columns' => 4,
                'required' => TRUE,
            );
        }

        $fields['description']['columns'] = 12;
        
        $fields['description']['required'] = FALSE;

        return view('admin.generic.edit', compact('title', 'icon', 'fields', 'action', 'method'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $product->categories()->sync($request->input('categories', []));
        $product->tags()->sync($request->input('tags', []));
        if ($request->input('photo', false)) {
            if (!$product->photo || $request->input('photo') !== $product->photo->file_name) {
                if ($product->photo) {
                    $product->photo->delete();
                }
                $product->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($product->photo) {
            $product->photo->delete();
        }

        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        abort_if(Gate::denies('product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->load('categories', 'tags');

        $title = $product->name;
        //trans('global.show') . ' ' . trans('cruds.product.title');

        $buttons = array(
                        'back_to_list' => array(
                                        'href' => route('admin.products.index'),
                                        'label' => trans('global.back_to_list'),
                                        'icon' => 	'fa fa-arrow-left',
                                        'class' => "btn btn-xs btn-info",
                        ),

                        'edit' => array(
                                        'href' => route('admin.products.edit', $product->id),
                                        'label' => trans('global.edit'),
                                        'icon' => 	'fa fa-pencil',
                                        'class' => 'btn btn-xs btn-warning',
                        ),
                        'delete' => array(
                                        'href' => route('admin.products.destroy', $product->id),
                                        'label' => trans('global.delete'),
                                        'icon' => 	'fa fa-trash',
                                        'class' => 'btn btn-xs btn-danger',
                                        'method' => 'delete',
                                        'confirm' => trans('global.areYouSure'),
                                        'title' => trans('global.confirm'),
                        ),

        );
        $fields = array();
        $keys = array(
            'id', 'name', 'description', 'price', 'categories', 'tags',
        );
        foreach($keys as $key)
        {
            $fields[$key] = array(
                'name' => $key,
                'value' => $product->$key,
                'label' => trans("cruds.product.fields.$key")
            );
        }

        $fields['categories']['value'] = [];
        foreach ($product->categories as $cat)
            $fields['categories']['value'][] = $cat->name;
        $fields['categories']['value'] = implode(', ', $fields['categories']['value']);
        //dd($fields['categories']['value']);

        $fields['tags']['value'] = [];
        foreach ($product->tags as $tag)
            $fields['tags']['value'][] = $tag->name;
        $fields['tags']['value'] = implode(', ', $fields['tags']['value']);

        return view('admin.generic.show', compact('product',
            'title', 'buttons', 'fields' ));
    }

    public function destroy(Product $product)
    {
        abort_if(Gate::denies('product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $product->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductRequest $request)
    {
        Product::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('product_create') && Gate::denies('product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Product();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
