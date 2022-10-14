<?php
namespace Xuandai\HelloWorld\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{

	public function execute()
	{
		$textDisplay = new \Magento\Framework\DataObject(array('text' => 'Xuandai'));
		$this->_eventManager->dispatch('xuandai_helloworld_display_text', ['mp_text' => $textDisplay]);
		echo $textDisplay->getText();
		exit;
	}
}