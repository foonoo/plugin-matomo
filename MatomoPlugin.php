<?php
namespace foonoo\plugins\foonoo\matomo;

use foonoo\Plugin;
use foonoo\events\ContentLayoutApplied;

class MatomoPlugin extends Plugin
{
    #[\Override]
    public function getEvents(): array
    {
        return [
//            ContentOutputGenerated::class => $this->processOutput(...)
            ContentLayoutApplied::class => $this->processOutput(...)
        ];
    }
    
    private function processOutput(ContentLayoutApplied $output)
    {
        $dom = $output->getDOM();
        xdebug_break();     
        if ($dom === null) {
            return;
        }
        $head = $dom->getElementsByTagName("head")->item(0); //$xpath->query('//head')->item(0);
        if($head !== null) {
            $scriptNode = $dom->createElement('script');
            $scriptNode->nodeValue = $this->getOption('script');
            $head->append($scriptNode);
        }
    }
}