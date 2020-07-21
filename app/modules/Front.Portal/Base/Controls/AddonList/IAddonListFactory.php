<?php declare(strict_types = 1);

namespace App\Modules\Front\Portal\Base\Controls\AddonList;

use App\Model\Database\Query\QueryObject;

interface IAddonListFactory
{

	public function create(QueryObject $queryObject): AddonList;

}
