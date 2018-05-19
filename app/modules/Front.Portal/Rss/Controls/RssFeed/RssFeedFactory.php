<?php declare(strict_types = 1);

namespace App\Modules\Front\Portal\Rss\Controls\RssFeed;

use App\Model\Database\ORM\Addon\Addon;
use App\Model\Database\ORM\EntityModel;
use App\Model\Database\Query\RssFeedQuery;
use Contributte\Nextras\Orm\QueryObject\Queryable;

final class RssFeedFactory
{

	/** @var EntityModel */
	private $em;

	/** @var IRssFeedFactory */
	private $rssFeedFactory;

	public function __construct(EntityModel $em, IRssFeedFactory $rssFeedFactory)
	{
		$this->em = $em;
		$this->rssFeedFactory = $rssFeedFactory;
	}

	public function createNewest(): RssFeed
	{
		$query = new RssFeedQuery();
		$query->byLatest();
		$query->setLimit(25);
		$list = $this->em->getRepositoryForEntity(Addon::class)->fetch($query, Queryable::HYDRATION_ENTITY);
		$control = $this->rssFeedFactory->create($list);

		$control->setTitle('Componette - latest addons');
		$control->setDescription('Latest added addons');

		return $control;
	}

	public function createByAuthor(string $author): RssFeed
	{
		$query = new RssFeedQuery();
		$query->byAuthor($author);
		$list = $this->em->getRepositoryForEntity(Addon::class)->fetch($query, Queryable::HYDRATION_ENTITY);
		$control = $this->rssFeedFactory->create($list);

		$control->setTitle('Componette - addons by ' . $author);
		$control->setDescription('Addons created by ' . $author);

		return $control;
	}

}
