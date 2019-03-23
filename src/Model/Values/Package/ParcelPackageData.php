<?php

namespace Inspirum\Balikobot\Model\Values\Package;

use Inspirum\Balikobot\Definitions\Option;

trait ParcelPackageData
{
    /**
     * Set the item at a given offset.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return void
     */
    abstract public function offsetSet($key, $value);

    /**
     * @param string $muType
     *
     * @return void
     */
    public function setMuType(string $muType): void
    {
        $this->offsetSet(Option::MU_TYPE, $muType);
    }

    /**
     * @param int $piecesCount
     *
     * @return void
     */
    public function setPiecesCount(int $piecesCount): void
    {
        $this->offsetSet(Option::PIECES_COUNT, $piecesCount);
    }

    /**
     * @param string $muType
     *
     * @return void
     */
    public function setMuTypeOne(string $muType): void
    {
        $this->offsetSet(Option::MU_TYPE_ONE, $muType);
    }

    /**
     * @param int $piecesCount
     *
     * @return void
     */
    public function setPiecesCountOne(int $piecesCount): void
    {
        $this->offsetSet(Option::PIECES_COUNT_ONE, $piecesCount);
    }

    /**
     * @param string $muType
     *
     * @return void
     */
    public function setMuTypeTwo(string $muType): void
    {
        $this->offsetSet(Option::MU_TYPE_TWO, $muType);
    }

    /**
     * @param int $piecesCount
     *
     * @return void
     */
    public function setPiecesCountTwo(int $piecesCount): void
    {
        $this->offsetSet(Option::PIECES_COUNT_TWO, $piecesCount);
    }

    /**
     * @param string $muType
     *
     * @return void
     */
    public function setMuTypeThree(string $muType): void
    {
        $this->offsetSet(Option::MU_TYPE_THREE, $muType);
    }

    /**
     * @param int $piecesCount
     *
     * @return void
     */
    public function setPiecesCountThree(int $piecesCount): void
    {
        $this->offsetSet(Option::PIECES_COUNT_THREE, $piecesCount);
    }

    /**
     * @param int $wrapBackCount
     *
     * @return void
     */
    public function setWrapBackCount(int $wrapBackCount): void
    {
        $this->offsetSet(Option::WRAP_BACK_COUNT, $wrapBackCount);
    }

    /**
     * @param string $wrapBackNote
     *
     * @return void
     */
    public function setWrapBackNote(string $wrapBackNote): void
    {
        $this->offsetSet(Option::WRAP_BACK_NOTE, $wrapBackNote);
    }

    /**
     * @param bool $appDisp
     *
     * @return void
     */
    public function setAppDisp(bool $appDisp = true): void
    {
        $this->offsetSet(Option::APP_DISP, (int) $appDisp);
    }

    /**
     * @param string $content
     *
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->offsetSet(Option::CONTENT, $content);
    }

    /**
     * @param bool $getPiecesNumbers
     *
     * @return void
     */
    public function setGetPiecesNumbers(bool $getPiecesNumbers = true): void
    {
        $this->offsetSet(Option::GET_PIECES_NUMBERS, (int) $getPiecesNumbers);
    }

    /**
     * @param string $contentOne
     *
     * @return void
     */
    public function setContentOne(string $contentOne): void
    {
        $this->offsetSet(Option::CONTENT_ONE, $contentOne);
    }

    /**
     * @param string $contentTwo
     *
     * @return void
     */
    public function setContentTwo(string $contentTwo): void
    {
        $this->offsetSet(Option::CONTENT_TWO, $contentTwo);
    }

    /**
     * @param string $contentThree
     *
     * @return void
     */
    public function setContentThree(string $contentThree): void
    {
        $this->offsetSet(Option::CONTENT_THREE, $contentThree);
    }

    /**
     * @param bool $adrService
     *
     * @return void
     */
    public function setAdrService(bool $adrService = true): void
    {
        $this->offsetSet(Option::ADR_SERVICE, (int) $adrService);
    }

    /**
     * @param array $adrContent
     *
     * @return void
     */
    public function setAdrContent(array $adrContent): void
    {
        $this->offsetSet(Option::ADR_CONTENT, $adrContent);
    }

    /**
     * @param bool $vdlService
     *
     * @return void
     */
    public function setVDLService(bool $vdlService): void
    {
        $this->offsetSet(Option::VDL_SERVICE, (int) $vdlService);
    }
}
