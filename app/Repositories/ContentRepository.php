<?php

namespace App\Repositories;

use App\Models\Content;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContentRepository
 * @package App\Repositories
 * @version November 22, 2018, 7:17 am UTC
 *
 * @method Content findWithoutFail($id, $columns = ['*'])
 * @method Content find($id, $columns = ['*'])
 * @method Content first($columns = ['*'])
*/
class ContentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'og_type',
        'og_description',
        'og_images',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Content::class;
    }
}
