<?php

namespace RedditBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use RedditBundle\Controller\reddit;
use RedditBundle\Entity\Surveillance;
use RedditBundle\Entity\LinkFound;
use Symfony\Component\DomCrawler\Crawler;

class RedditController extends Controller
{
	
	private $arrayWordsToFind = array(
			"LEG",
			"legacy.network",
			"enesimo",
			"Almonacid",
			"Faraggi",
			"Figielski",
			"Ricard",
			"Michel",
			"felipefaraggi",
			"lastwill",
			"digipulse",
			
	);
	
	private $urlHackerNews = "https://news.ycombinator.com/";

	private $arrayURLToSurvey = array(
			"/r/Bitcoin",
			"/r/cofoundit",
			"/r/Augur",
			"/r/BitNation",
			"/r/EthAnalysis",
			"/r/dao",
			"/r/ethlaw",
			"/r/ethdev",
			"/r/CryptoDerivatives",
			"/r/ICOAnalysis",
			"/r/icocrypto",
			"/r/dogethereum",
			"/r/EthCrowdfund",
			"/r/ethdapps",
			"/r/ethereum",
			"/r/EthereumClassic",
			"/r/ethereumjobs",
			"/r/ethereumprice",
			"/r/EthereumProgramming",
			"/r/ethereumprojects",
			"/r/EtherEx",
			"/r/EtherMining",
			"/r/ethes",
			"/r/ethernews",
			"/r/ethinvestor",
			"/r/ETHSTAKERS",
			"/r/ethtokens",
			"/r/ethtrader",
			"/r/groupgnosis",
			"/r/ipfs",
			"/r/joincolony",
			"/r/MakerDAO",
			"/r/MicroDAO",
			"/r/slockit",
			"/r/solidity",
			"/r/SolidityDevelopment",
			"/r/TheDao",
			"/r/thedaotrader",
			"/r/trueethereum",
			"/r/anTrader",
			"/r/Antshares",
			"/r/Bitcoin",
			"/r/BitcoinMarkets",
			"/r/btc",
			"/r/CryptoCurrency",
			"/r/CryptoMarkets",
			"/r/ethereum",
			"/r/factom",
			"/r/GolemProject",
			"/r/GolemTrader",
			"/r/gridcoin",
			"/r/ICONOMI",
			"/r/ICONOMIuncensored",
			"/r/Iota",
			"/r/reddCoin",
			"/r/rubycoin",
			"/r/shapeshiftio",
			"/r/siacoin",
			"/r/siatrader",
			"/r/stratisplatform",
			"/r/SwarmCity",
	);
	
	private $urlBaseReddit = "https://www.reddit.com";
	
	private $emailContent = "";
	
	
	public function crawlingAction() {

		$this->emailContent = "";

		$this->crawlingHackerNewsAction();
		$this->crawlingRedditAction();

		$this->saveAndSendEmail();
		
		return $this->render('RedditBundle:Reddit:index.html.twig', array(
		
		));
	}
	
	public function crawlingHackerNewsAction() {

		try {
			
			$liste_liens = $this->getLinksOnPage($this->urlHackerNews, "//a[@class='storylink']");
			
			$i = 0;
			foreach($liste_liens as $link) {
				$this->checkWordsInContent($link);
				$i++;
			}
			

		
		} catch (\Exception $e) {
			
		}
	}
	
	private function saveAndSendEmail() {

		if (!empty($this->emailContent)) {
			$surveillance = new Surveillance();
			$surveillance->setContent($this->emailContent);
				
			$em = $this->getDoctrine()->getManager();
			$em->persist($surveillance);
			$em->flush();
		
			$message = (new \Swift_Message())
			->setFrom(array('no-reply@legacy.network' => "Nous" ))
			->setTo('contact@legacy.network')
			->setSubject("Reddit surveillance")
			->setBody($this->emailContent, "text/html");
			;
		
			$this->get('mailer')->send($message);
		}
	}
	
	public function crawlingRedditAction() {

		foreach ($this->arrayURLToSurvey as $urlToSurvey) {

			
			try {
				
				$url = $urlToSurvey;
				if (strpos($url, "http") === false) {
					$url = $this->urlBaseReddit.$url;
				}
				
				$liste_liens = $this->getLinksOnPage($url, "//p[@class='title']//a");
					
				foreach($liste_liens as $link) {
					$url = $link;
					if (strpos($url, "http") === false) {
						$url = $this->urlBaseReddit.$url;
					}
			
					$this->checkWordsInContent($url);
				}
	
				

			} catch (\Exception $e) {
					
			}
		}
	}
	
	private function getLinksOnPage($url, $xpathForLinks) {
		$content = @file_get_contents($url);
		
		$crawler = new Crawler($content);
		
		$liste_liens = array();
		try {
			$liste_liens = $crawler
			->filterXpath(
					$xpathForLinks)
					->extract('href');
		} catch(\Exception $e) {}
		
		return $liste_liens;
	}
	
	private function checkWordsInContent($url) {
		
			$linkFound = $this->getDoctrine()->getManager()->getRepository('RedditBundle:LinkFound')->findByContent($url);
			
			if ($linkFound == null) {
			
				$content = @file_get_contents($url);
						
				foreach($this->arrayWordsToFind as $currentWord) {
					foreach($this->getWordVariants($currentWord) as $word) {
						$this->emailContent .= "<br />Le mot '".$word."' a été trouvé sur la page ".$url;
						
						$em = $this->getDoctrine()->getManager();
						$linkFound = new LinkFound();
						$linkFound->setContent($url);
						$em->persist($linkFound);
						$em->flush();
					}
				}
			
			}
		
		
	}
	
	private function getWordVariants($word) {
		$wordVariants = array(
				" ".$word." ",
				$word." ",
				" ".$word.".",
				$word.",",
				$word.":"
		);
		
		return $wordVariants;
	}
	
	public function batchAction() {
		$reddit = new reddit();
		
		$response = $reddit->getListing("Augur", 5);

		$response = $response->data->children;
		
		return $this->render('RedditBundle:Reddit:index.html.twig', array(
				
		));
	}


	public function redirectAction() {
		$reddit = new reddit();
		
		$response = $reddit->getListing("Augur", 5);

		var_dump($response);
		
		$response = $response->data->children;
		
		var_dump($response);
		

		return $this->render('RedditBundle:Reddit:index.html.twig', array(
		
		));
	}
	
}
