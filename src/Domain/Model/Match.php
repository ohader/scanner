<?php
namespace TYPO3\CMS\Scanner\Domain\Model;

class Match
{
    const TYPE_BREAKING = 'BREAKING';
    const TYPE_DEPRECATION = 'DEPRECATION';
    const TYPE_IMPORTANT = 'IMPORTANT';
    const TYPE_FEATURE = 'FEATURE';

    private $matcher;
    private $identifier;
    private $indicator;
    private $subject;
    private $message;
    private $line;
    private $type;

    private $restFiles = [];

    public function __construct(
        string $matcher,
        string $indicator,
        string $subject,
        string $message,
        int $line,
        string $type
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

        $this->matcher = $matcher;
        $this->indicator = $indicator;
        $this->subject = $subject;
        $this->message = $message;
        $this->line = $line;
        $this->type = $this->validateType($type);
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
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
    public function getMatcher(): string
    {
        return $this->matcher;
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
    public function getSubject(): string
    {
        return $this->subject;
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

    private function validateType(string $type): string
    {
        $validTypes = [
            self::TYPE_BREAKING,
            self::TYPE_DEPRECATION,
            self::TYPE_FEATURE,
            self::TYPE_IMPORTANT
        ];
        if (!in_array($type, $validTypes, true)) {
            throw new \RuntimeException('Invalid type ' . htmlspecialchars($type) . ' given.', 1513148761);
        }
        return $type;
    }
}