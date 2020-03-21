<?php

/*
 #         _____                           
 #        /  ___|                          
 #        \ `--.  _ __    __ _   ___   ___ 
 #         `--. \| '_ \  / _` | / __| / _ \
 #        /\__/ /| |_) || (_| || (__ |  __/
 #        \____/ | .__/  \__,_| \___| \___|
 #               | |                       
 #               |_|                       
 #       _             _      
 #      | |           (_)     
 #      | |     _   _  _  ___ 
 #      | |    | | | || |/ __|
 #      | |____| |_| || |\__ \
 #      \_____/ \__,_||_||___/
 #
 # @author : SpaceLuis
 # @github : https://github.com/Space-Luis
 # @E-Mail : SpaceLuis769@gmail.com
 # @KakaoTalk : @SpaceLuis
 # @Band : Unknown.....(Sorry)
*/

namespace SpaceLuis;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\utils\Config;

use pocketmine\network\mcpe\protocol\ModalFormRequestPacket;
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;
use pocketmine\event\server\DataPacketReceiveEvent;

use pocketmine\Player;

class Main extends PluginBase implements Listener{

    public const FORM_RESPONSE = 77177;

    /** @var Config */
    public $data;

    public $db = [];

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this,$this);

        @mkdir($this->getDataFolder());
		$this->data = new Config($this->getDataFolder() . "data.yml", Config::YAML);
		$this->db = $this->data->getAll();
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
		$name = $player->getName();
		if(!isset($this->db[$name])){
			$this->termUI($player);
		} else {
		    $player->addTitle("§b# §fWelcome","§7AD 서버에 오신걸 환영합니다!");
		}
    }

    public function onDisable(){
		$this->data->setAll($this->db);
		$this->data->save();
	}

    public function termUI(Player $player) {
        $form = [
            "type" => "modal",
            "title" => "§b[ §fAD Server 이용 약관 §b]",
			"content" => "§b# §fWelcome to AD Server!\n\n§c▶ §f제 1조 ( 목적 )\n이 약관은 AD-Server(이하 “서버”라 합니다)가 제공하는 게임 서비스(이하 “서비스”라 합니다) 이용과 관련하여 갑과 이용자간의 권리∙의무 및 기타 필요한 제반사항을 정함을 목적으로 합니다.\n\n§c▶ §f제 2조 ( 용어의 정리 )\n이 약관에서 사용하는 용어의 정의는 다음 각호와 같으며, 정의하지 않은 용어의 해석은 관련 법령 및 상관례에 따릅니다.\n“이용고객“이란 서버가 제공하는 서비스를 이용하기 위해 마인크래프트라는 게임 내에서 서버기능중 “AD Server“에 들어온 자를 말합니다.
“이용자”란 이 약관 및 개인정보처리방침에 동의하고, 서버가 제공하는 서비스 이용자격을 부여 받은 이용고객을 말합니다.
“서비스”란 서버가 제공하는 게임 서비스 일체를 의미합니다.\n\n§c▶ §f제 3조 ( 약관의 효력 및 변경 )\n① 이 약관은 이용자가 알 수 있도록 회사의 웹사이트에 게시하거나 어플리케이션 내의 연결화면 등을 통해 이용자에게 공지함으로써 효력이 발생합니다.
② 회사는 「전자상거래 등에서의 소비자보호에 관한 법률」, 「약관의 규제에 관한 법률」, 「게임산업진흥에 관한 법률」, 「정보통신망이용촉진 및 정보보호 등에 관한 법률」, 「콘텐츠산업진흥법」 등 관련 법령에 위배되지 않는 범위에서 이 약관을 변경할 수 있습니다. 변경되는 약관은 적용일자, 변경내용 및 변경사유 등을 명시하여 그 적용일 7일 이전부터 서비스 공식 블로그 또는 단말기 알림(Push 알림) 등을 통해 이용자에게 공지합니다. 다만, 이용자의 권리∙의무에 중대한 영향을 미치는 사항에 대해서는 그 적용일 30일 이전부터 공지합니다.
③ 이용자는 변경되는 약관에 대해 동의하지 않을 수 있으며, 변경되는 약관에 동의하지 않는 경우에는 서비스 이용을 중단하고 서비스에서 탈퇴를 할 수 있습니다. 다만, 제2항의 방법으로 변경되는 약관 공지 시 이용자가 별도의 의사표시를 하지 않으면 승낙한 것으로 본다고 공지하였음에도 불구하고, 변경되는 약관의 적용일 전일까지 회사에 대해 명시적으로 의사표시를 하지 아니하는 경우 또는 이용자가 변경되는 약관 적용일 이후에도 계속하여 서비스를 이용하는 경우에는 변경된 약관에 동의한 것으로 봅니다\n\n§c▶ §f제 4조 ( 약관 외 준칙 )\n이 약관에서 정하지 아니한 사항에 관하여는 「전자상거래 등에서의 소비자보호에 관한 법률」, 「약관의 규제에 관한 법률」, 「게임산업진흥에 관한 법률」, 「정보통신망이용촉진 및 정보보호 등에 관한 법률」, 「콘텐츠산업진흥법」 등 관련 법령 및 상관례에 따릅니다.\n\n§c▶ §f제 5조 ( 이용 계약의 성립 )\n① 서비스 이용계약은 이용고객이 애플리케이션을 설치 및 구동하여 이 약관 및 개인정보처리방침에 동의한 다음 서비스 이용신청을 하고, 회사가 그 이용신청에 승낙함으로써 성립합니다. 이용고객의 서비스 이용신청 완료 후 단말기내에서 애플리케이션이 정상적으로 구동되는 경우에는 서비스 이용이 승낙된 것으로 봅니다. ② 이용자는 서비스 이용과정에서 타인의 개인정보를 도용하는 경우 이 약관에 의한 이용자의 권리를 주장할 수 없으며, 회사는 이용계약을 취소하거나 해지할 수 있습니다. 이용자가 플랫폼사업자에게 개인정보를 제공하고 플랫폼사업자를 통해 서비스를 이용하는 경우에도 동일하게 간주됩니다. ③ 회사는 다음 각호의 어느 하나에 해당하는 이용신청에 대해서는 승낙을 하지 않을 수 있습니다.\n1.서비스 운영정책에 따라 최근 3개월 내 이용제한을 받았거나, 영구제한을 받은 이용자가 이용신청을 하는 경우\n2.회사가 체결한 계약에 따라 또는 특정 국가에서 접속하는 이용자에게 서비스를 제공하는 것을 제한할 필요가 있는 경우\n3.「게임산업진흥에 관한 법률」, 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」 및 그 밖의 관련 법령에서 금지하는 위법행위를 할 목적으로 이용신청을 하는 경우
그 밖에 제1호 내지 제3호에 준하는 사유로서 승낙이 부적절하다고 판단되는 경우",
            "button1" => "§b>> §f동의 §b<<",
            "button2" => "§b>> §f미동의 §b<<",
        ];
        $pk = new ModalFormRequestPacket();
        $pk->formId = self::FORM_RESPONSE;
        $pk->formData = json_encode($form);
        $player->sendDataPacket($pk);
    }

    public function onReceive(DataPacketReceiveEvent $event) {
        $pk = $event->getPacket();
        $player = $event->getPlayer();

        $name = $player->getName();
        if ($pk instanceof ModalFormResponsePacket) {
            if ($pk->formId == self::FORM_RESPONSE) {
                $data = json_decode($pk->formData, true);
                if (!is_null($data)) {
					if ($data) {
						$this->db[$name]["약관동의"] = "O";
						$player->sendMessage("§b[ §fSystem §b] §7약관에 동의해주셔서 감사합니다.");
					} else {
						$player->kick("약관 미동의로 게임을 플레이 하실 수 없습니다. 다시 접속하여 약관에 동의해주세요.");
					}
				}
            }
        }
    }
}