<?php declare(strict_types=1);

namespace App\Module\Anonymous\Serial\components\ButtonLike;

use App\Model\Database\Entity\SerialEntity;
use App\Model\Facade\User\ButtonLike\LikeSerialFacade;
use Nette\Application\UI\Control;

class ButtonLike extends Control
{

    public array $onLike;
    public array $onDislike;

	private SerialEntity $serial;
	private LikeSerialFacade $likeSerialFacade;


	public function __construct(SerialEntity $serial, LikeSerialFacade $likeSerialFacade)
    {
        $this->serial = $serial;
		$this->likeSerialFacade = $likeSerialFacade;
	}


    public function handleLike(): void
    {
        $this->likeSerialFacade->like($this->serial);
        $this->onLike();
    }


    public function handleDislike(): void
    {
        $this->likeSerialFacade->dislike($this->serial);
        $this->onDislike();
    }


    public function render(): void
    {
        $this->getTemplate()->liked = $this->likeSerialFacade->isLiked($this->serial);
        $this->getTemplate()->setFile(__DIR__ . "/templates/buttonLike.latte");
        $this->getTemplate()->render();
    }

}