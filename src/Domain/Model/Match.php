<?php
namespace TYPO3\CMS\Scanner\Domain\Model;

class Match
{
    private $identifier;
    private $indicator;
    private $message;
    private $line;

    private $restFiles = [];

    public function __construct(
        string $indicator,
        string $message,
        int $line
    )
    {
        $this->identifier = str_replace(
            '.',
            '',
            uniqid(
                (string)mt_rand(),
                true
            )
        );

        $this->indicator = $indicator;
        $this->message = $message;
        $this->line = $line;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getIndicator(): string
    {
        return $this->indicator;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return $this->line;
    }

    /**
     * @return array
     */
    public function getRestFiles(): array
    {
        return $this->restFiles;
    }

    /**
     * @param array $restFiles
     */
    public function setRestFiles(array $restFiles)
    {
        $this->restFiles = $restFiles;
    }
}