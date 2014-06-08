<?php

class Bar
{
	const MOBILE_DESCRIPTION_CHARS_LIMIT = 500;

	private $descriptionInit; 
	private $descriptionMore; 
	private $description = 'Meanwhile dishes such as curried chicken and okra turnovers and bacalao fried rice have been created to complement exotic and rather yummy cocktails such as the Drunken Dragon’s Milk<br>Which combines green-tea vodka blended with coconut purée, pandan syrup, Chinese five spice bitters and Thai basil, and Yellow Fever, a concoction of rye, Benedictine and egg white. The décor is also influenced by Macao: lots of warm wood with a gorgeous glass-backed bar and antique brica- brac scattered. <br> <br> Macao was a Portuguese colony in China for centuries, which accounts for the unique menu structure and the melding of European and Asian cuisine - many of the appetizers and entrees are offered cooked “Chinese style” or “Portugese style”.<br> From the team behind the acclaimed Employees Only and David Waltuck, chef and owner of Chanterelle, comes a new super-hip Tribeca spot. Taking its inspiration from the brothels and opium dens of old 1930s Macao, customers are encouraged to leave their inhibitions at the door and “embrace a little dose of erotic abandon”. And most are more than happy to oblige.<br><br>Meanwhile dishes such as curried chicken and okra turnovers and bacalao fried rice have been created to complement exotic and rather yummy cocktails such as the Drunken Dragon’s Milk, which combines green-tea vodka blended with coconut purée, pandan syrup, Chinese five spice bitters and Thai basil, and Yellow Fever, a concoction of rye, Benedictine and egg white. The décor is also influenced by Macao: lots of warm wood with a gorgeous glass-backed bar and antique brica- brac scattered. <br> <br> Macao was a Portuguese colony in China for centuries, which accounts for the unique menu structure and the melding of European and Asian cuisine - many of the appetizers and entrees are offered cooked “Chinese style” or “Portugese style”. <br> <br> From the team behind the acclaimed Employees Only and David Waltuck, chef and owner of Chanterelle, comes a new super-hip Tribeca spot. Taking its inspiration from the brothels and opium dens of old 1930s Macao, customers are encouraged to leave their inhibitions at the door and “embrace a little dose of erotic abandon”. And most are more than happy to oblige.';

    /**
     * Set descriptions
     */
    public function setDescriptions()
    {
        $fullArray = explode("<br>", $this->description);
        $charInit = 0;
        $init = $fullArray[0];
        $delta = abs(strlen($init) - self::MOBILE_DESCRIPTION_CHARS_LIMIT);
        $more = "";
        for ($i = 1 ; $i < count($fullArray) ; $i++) {
        	$cur = $fullArray[$i];
        	$curNb = strlen($cur);
        	$curDelta = abs((strlen($init) + $curNb) - self::MOBILE_DESCRIPTION_CHARS_LIMIT);

        	if ($curDelta < $delta) {
        		$init .= "<br>".$cur;
        		$delta = $curDelta;
        	} else {
        		$moreArray = array_slice($fullArray, $i);
        		$more = implode( "<br>" , $moreArray);
        		break;
        	}
        }
        $this->descriptionInit = $init;
        $this->descriptionMore = $more;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get descriptionInit
     *
     * @return string 
     */
    public function getDescriptionInit()
    {
        return $this->descriptionInit;
    }
    /**
     * Get descriptionMore
     *
     * @return string 
     */
    public function getDescriptionMore()
    {
        return $this->descriptionMore;
    }


}
$bar = new Bar();
$bar->setDescriptions();

echo("<b>Description full : </b>".$bar->getDescription());
echo("<br>");
echo("<br>");
echo("<b>Description init : </b>".$bar->getDescriptionInit());
echo("<br>");
echo("<br>");
echo("<b>Description more : </b>".$bar->getDescriptionMore());