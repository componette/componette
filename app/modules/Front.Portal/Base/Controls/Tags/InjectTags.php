<?php declare (strict_types = 1);

namespace App\Modules\Front\Portal\Base\Controls\Tags;

trait InjectTags
{

	protected Tags $tags;

	public function injectTags(Tags $tags): void
	{
		$this->tags = $tags;
	}

}
