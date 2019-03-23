<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use Yassi\NestedForm\NestedForm;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Post';

//    public static $with = ['wp_postmeta'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'post_title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'post_title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'ID')->sortable(),

            DateTime::make('Post Modified')
                ->withMeta(['value' => $this->post_modified ?? date('Y-m-d h:i:s')])
                ->hideWhenUpdating(),

            Text::make('Post Title'),

            Text::make('Slug', 'post_name')
                ->hideFromIndex(),

            BelongsToMany::make('Category'),
            BelongsToMany::make('Tags'),

            Text::make('Focus Keyword(s)', function () {
                return $this->post_metas()->where('meta_key', '_yoast_wpseo_focuskw')->pluck('meta_value')[0] ?? '';
            })->hideFromIndex(),


            Text::make('Focus', function () {
                $value = $this->post_metas()->where('meta_key', '_yoast_wpseo_linkdex')->pluck('meta_value')[0] ?? '';
                return $value . '%';
            }),

            Text::make('Content', function () {
                $value = $this->post_metas()->where('meta_key', '_yoast_wpseo_content_score')->pluck('meta_value')[0] ?? '';
                return $value . '%';
            }),

            Trix::make('Post Content')->withFiles('public'),

            HasMany::make('Post Meta', 'post_metas', 'App\Nova\PostMeta'),

            Text::make('Post Type')
                ->withMeta(['value' => $this->post_type ?? 'knowledgebase'])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),

            Text::make('Post Excerpt')
                ->withMeta(['value' => $this->post_excerpt ?? 'n/a'])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),

            Text::make('To Ping')
                ->withMeta(['value' => $this->to_ping ?? 'n/a'])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),

            Text::make('Pinged')
                ->withMeta(['value' => $this->pinged ?? 'n/a'])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),

            Text::make('Post Content Filtered')
                ->withMeta(['value' => $this->post_content_filtered ?? 'n/a'])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),

            DateTime::make('Post Date')
                ->withMeta(['value' => $this->post_date ?? date('Y-m-d h:i:s')])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),

            DateTime::make('Post Date Gmt')
                ->withMeta(['value' => $this->post_date_gmt ?? date('Y-m-d h:i:s')])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),

            DateTime::make('Post Modified Gmt')
                ->withMeta(['value' => $this->post_modified_gmt ?? date('Y-m-d h:i:s')])
                ->hideWhenUpdating()
                ->hideFromIndex()
                ->hideFromDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
