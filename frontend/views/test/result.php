<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\data\Pagination;

/* @var $resulrt array */
?>

<?= $this->render('/_block/_header_payment'); ?>


<?php foreach ($result as $res): ?>
    <h2>
        Тест: <?= $res['title'] ?>
    </h2>
    <h2>
        Результат: <?= $res['result']['answer'] ?>
    </h2>
    <h2>
        Запрос: <?= $res['result']['query_values'] ?>
    </h2>
    <br><br><br> 
                 
   <?php $cur_colors =[];
   if ($res['result']['query_colors'] != '') {
       $cur_colors = explode(',', str_replace(' ', '',$res['result']['query_colors']));
   } 
   ?>
<?php endforeach; ?>
    <?php
    $box_color = ['белый' => 'color-10','синий' => 'color-12','голубой' => 'color-2','фиолетовый' => 'color-13','серый' => 'color-11','розовый' => 'color-9','бежевый' => 'color-1','черный' => 'color-8','желтый' => 'color-3','зеленый' => 'color-4','красный' => 'color-6','коричневый' => 'color-5','оранжевый' => 'color-7','мультиколор'=> 'color-pick1' ];
    $merchants = json_decode('[{"_id":64739,"name":"montbleustore.com"},{"_id":70945,"name":"action5.ru"},{"_id":8378,"name":"cablook.ru"},{"_id":9408,"name":"svyaznoy.ru"},{"_id":10884,"name":"notik.ru"},{"_id":25263,"name":"carrida.ru"},{"_id":32409,"name":"printclick.ru"},{"_id":63808,"name":"coolicool.com"},{"_id":71570,"name":"hoodiebuddie.ru"},{"_id":75916,"name":"floraexpress.ru"},{"_id":75925,"name":"clinique.ru"},{"_id":9958,"name":"yoox.com"},{"_id":11661,"name":"topbrands.ru"},{"_id":12027,"name":"ozon.ru"},{"_id":18869,"name":"decoretto.ru"},{"_id":20129,"name":"shop.fc-zenit.ru"},{"_id":21101,"name":"foroffice.ru"},{"_id":21189,"name":"babadu.ru"},{"_id":22501,"name":"bebakids.ru"},{"_id":23631,"name":"mexx.ru"},{"_id":23707,"name":"audiomania.ru"},{"_id":23719,"name":"pdapart.ru"},{"_id":26447,"name":"activizm.ru"},{"_id":26569,"name":"trendsport.ru"},{"_id":27099,"name":"mebelion.ru"},{"_id":27813,"name":"boffo.ru"},{"_id":28089,"name":"trendsbrands.ru"},{"_id":29789,"name":"piter.com"},{"_id":33001,"name":"puffy-shop.ru"},{"_id":36667,"name":"footballstore.ru"},{"_id":40329,"name":"atlasformen.ru"},{"_id":41095,"name":"pharmacosmetica.ru"},{"_id":41799,"name":"shop.philips.ru"},{"_id":42071,"name":"lamoda.ru"},{"_id":42255,"name":"ogo1.ru"},{"_id":42339,"name":"autodevice-nn.ru"},{"_id":43445,"name":"merclondon.ru"},{"_id":46027,"name":"pudra.ru"},{"_id":46425,"name":"likemyhome.ru"},{"_id":46459,"name":"e96.ru"},{"_id":47249,"name":"svstime.ru"},{"_id":48081,"name":"bemad.ru"},{"_id":50757,"name":"shopbop.com"},{"_id":50803,"name":"laredoute.ru"},{"_id":56004,"name":"sapato.ru"},{"_id":56129,"name":"store77.net"},{"_id":58607,"name":"showrooms.ru"},{"_id":59126,"name":"mir-prekrasnogo.ru"},{"_id":59531,"name":"sammydress.com"},{"_id":59615,"name":"ulmart.ru"},{"_id":60347,"name":"otto.ru"},{"_id":60369,"name":"miniinthebox.com"},{"_id":60370,"name":"lightinthebox.com"},{"_id":60373,"name":"kupi-kolyasku.ru"},{"_id":60374,"name":"butik.ru"},{"_id":60379,"name":"redcube.ru"},{"_id":60961,"name":"homeme.ru"},{"_id":60962,"name":"stylepit.ru"},{"_id":61005,"name":"tom-tailor-online.ru"},{"_id":61006,"name":"kinderly.ru"},{"_id":61007,"name":"kidstore.ru"},{"_id":61085,"name":"bashmag.ru"},{"_id":61103,"name":"aliexpress.com"},{"_id":61104,"name":"vipbikini.ru"},{"_id":61109,"name":"postel-deluxe.ru"},{"_id":61695,"name":"003.ru"},{"_id":63146,"name":"bestwatch.ru"},{"_id":63340,"name":"kupivip.ru"},{"_id":63898,"name":"everbuying.net"},{"_id":64181,"name":"mvideo.ru"},{"_id":64283,"name":"elyts.ru"},{"_id":65852,"name":"yves-rocher.ru"},{"_id":66782,"name":"dx.com"},{"_id":66802,"name":"acoolakids.ru"},{"_id":67102,"name":"inksystem.biz"},{"_id":67219,"name":"conceptclub.ru"},{"_id":70427,"name":"chefmarket.ru"},{"_id":66798,"name":"mediamarkt.ru"},{"_id":66799,"name":"mytoys.ru"},{"_id":66969,"name":"holodilnik.ru"},{"_id":67098,"name":"frenza.ru"},{"_id":68271,"name":"panchemodan.ru"},{"_id":68613,"name":"moscvettorg.ru"},{"_id":68785,"name":"sportiv.ru"},{"_id":68786,"name":"groupprice.ru"},{"_id":69491,"name":"velosite.ru"},{"_id":69498,"name":"gipostroy.ru"},{"_id":69549,"name":"my-choupette.ru"},{"_id":69570,"name":"vamsvet.ru"},{"_id":69581,"name":"pleer.ru"},{"_id":69618,"name":"roxy-russia.ru"},{"_id":69658,"name":"kideria.ru"},{"_id":69659,"name":"quiksilver.ru"},{"_id":69660,"name":"bambolo.ru"},{"_id":69661,"name":"dcrussia.ru"},{"_id":69663,"name":"mladenec-shop.ru"},{"_id":69686,"name":"condom-shop.ru"},{"_id":69694,"name":"mebelvia.ru"},{"_id":69716,"name":"4lapy.ru"},{"_id":69741,"name":"toy.ru"},{"_id":69744,"name":"pichshop.ru"},{"_id":69745,"name":"qpstol.ru"},{"_id":69803,"name":"q2you.eu"},{"_id":69979,"name":"pult.ru"},{"_id":70010,"name":"lacywear.ru"},{"_id":70177,"name":"ramayoga.ru"},{"_id":70211,"name":"cosmoprofi.ru"},{"_id":70291,"name":"aizel.ru"},{"_id":70353,"name":"divine-light.ru"},{"_id":70424,"name":"e-xpedition.ru"},{"_id":70426,"name":"re-store.ru"},{"_id":70428,"name":"grandstock.ru"},{"_id":70467,"name":"topradar.ru"},{"_id":70585,"name":"wildberries.ru"},{"_id":70586,"name":"hadleybags.ru"},{"_id":70597,"name":"123.ru"},{"_id":70726,"name":"technopark.ru"},{"_id":70782,"name":"robotbaza.ru"},{"_id":70793,"name":"proball.ru"},{"_id":70850,"name":"intimshop.ru"},{"_id":71017,"name":"dolina-podarkov.ru"},{"_id":71022,"name":"alltime.ru"},{"_id":71030,"name":"gearbest.com"},{"_id":71032,"name":"onona.ru"},{"_id":71033,"name":"sportgrad.ru"},{"_id":71035,"name":"roskosmetika.ru"},{"_id":71040,"name":"ecco-shoes.ru"},{"_id":71043,"name":"finn-flare.ru"},{"_id":71051,"name":"tehnosila.ru"},{"_id":71119,"name":"love-organic.ru"},{"_id":71140,"name":"dochkisinochki.ru"},{"_id":71275,"name":"kknyazeva.ru"},{"_id":71337,"name":"etagerca.ru"},{"_id":71450,"name":"just.ru"},{"_id":71554,"name":"kniga.ru"},{"_id":71662,"name":"stolplit.ru"},{"_id":71712,"name":"electroburg.ru"},{"_id":71800,"name":"proskater.ru"},{"_id":71814,"name":"lacoste.ru"},{"_id":71815,"name":"occasion.ru"},{"_id":71816,"name":"superstep.ru"},{"_id":71819,"name":"moymir.ru"},{"_id":71830,"name":"netprint.ru"},{"_id":71981,"name":"iledebeaute.ru"},{"_id":72135,"name":"220-volt.ru"},{"_id":72245,"name":"quelle.ru"},{"_id":72268,"name":"decathlon.ru"},{"_id":72328,"name":"almea.ru"},{"_id":72428,"name":"darvindog.ru"},{"_id":72571,"name":"nozhikov.ru"},{"_id":72574,"name":"darom.ru"},{"_id":72601,"name":"buyon.ru"},{"_id":72655,"name":"agentprovocateur.ru"},{"_id":72684,"name":"vans.ru"},{"_id":72769,"name":"skidkabum.ru"},{"_id":72773,"name":"vichyconsult.ru"},{"_id":72777,"name":"blackstarshop.ru"},{"_id":73069,"name":"toolking.ru"},{"_id":73210,"name":"qnail.ru"},{"_id":73312,"name":"electriccity.ru"},{"_id":73421,"name":"pet-online.ru"},{"_id":73512,"name":"vokruglamp.ru"},{"_id":73882,"name":"korablik.ru"},{"_id":73900,"name":"prirodaural.ru"},{"_id":73904,"name":"shop.mts.ru"},{"_id":73911,"name":"westland.ru"},{"_id":73913,"name":"oasap.com"},{"_id":73919,"name":"lifemebel.ru"},{"_id":73932,"name":"7cont.ru"},{"_id":73939,"name":"basketshop.ru"},{"_id":73946,"name":"snowqueen.ru"},{"_id":73957,"name":"banggood.com"},{"_id":73962,"name":"kladzdor.ru"},{"_id":73968,"name":"ralf.ru"},{"_id":73974,"name":"umnitsa.ru"},{"_id":74281,"name":"mrdom.ru"},{"_id":74335,"name":"divan.ru"},{"_id":74668,"name":"bclight.ru"},{"_id":74899,"name":"thefurnish.ru"},{"_id":75436,"name":"vseinstrumenti.ru"},{"_id":75438,"name":"sendflowers.ru"},{"_id":75482,"name":"redcube.ru"},{"_id":75516,"name":"myprintbar.ru"},{"_id":75597,"name":"4glaza.ru"},{"_id":75609,"name":"litres.ru"},{"_id":75610,"name":"voltmarket.ru"},{"_id":75625,"name":"tvoe.ru"},{"_id":75626,"name":"agnes.ru"},{"_id":75656,"name":"shop-delonghi.ru"},{"_id":75657,"name":"bagway.ru"},{"_id":75715,"name":"icover.ru"},{"_id":75733,"name":"loccitane.ru"},{"_id":75735,"name":"beeline.ru"},{"_id":75740,"name":"petrovich.ru"},{"_id":75755,"name":"nebo.ru"},{"_id":75763,"name":"fiction.eksmo.ru"},{"_id":75781,"name":"enjoyme.ru"},{"_id":75782,"name":"kenwood-shop.ru"},{"_id":75783,"name":"ru.ivideon.com"},{"_id":75800,"name":"mebel.ru"},{"_id":75810,"name":"shop.misslo.com"},{"_id":75881,"name":"power-way.ru"},{"_id":75882,"name":"spim.ru"},{"_id":75904,"name":"multivarka.pro"},{"_id":75907,"name":"bookvoed.ru"},{"_id":75924,"name":"angstrem-mebel.ru"},{"_id":75936,"name":"gracy.ru"},{"_id":76010,"name":"ibody.ru"},{"_id":76011,"name":"izobility.com"},{"_id":76012,"name":"kids4kids.ru"},{"_id":76136,"name":"kupinatao.com"},{"_id":76139,"name":"moon-trade.ru"},{"_id":76140,"name":"paper-shop.ru"},{"_id":76150,"name":"ru.puma.com"},{"_id":76151,"name":"read.ru"},{"_id":76153,"name":"vassatrend.ru"},{"_id":76154,"name":"voltoff.ru"},{"_id":76170,"name":"procanvas.ru"},{"_id":76234,"name":"theoutlet.ru"},{"_id":76235,"name":"ponominalu.ru"},{"_id":76236,"name":"nils.ru"},{"_id":76237,"name":"7770000.ru"},{"_id":76254,"name":"1c-interes.ru"},{"_id":76255,"name":"domsporta.com"},{"_id":76256,"name":"lab-krasoty.ru"},{"_id":76257,"name":"liniilubvi.ru"},{"_id":76277,"name":"ezakaz.ru"},{"_id":76278,"name":"traektoria.ru"},{"_id":76280,"name":"robek.ru"},{"_id":76281,"name":"ttstv.ru"},{"_id":76353,"name":"gasjeans.ru"},{"_id":76368,"name":"grand-flora.ru"},{"_id":76369,"name":"shop.highscreen.ru"},{"_id":76385,"name":"shopozz.ru"},{"_id":76389,"name":"shop24.ru"},{"_id":76415,"name":"myintimtoy.com"},{"_id":76445,"name":"ronikon.ru"},{"_id":76448,"name":"clockshop.ru"},{"_id":76464,"name":"fashionmia.com"},{"_id":76465,"name":"letu.ru"},{"_id":76484,"name":"micromaxstore.ru"},{"_id":76566,"name":"askona.ru"},{"_id":76666,"name":"kabashop.ru"},{"_id":76789,"name":"rockettime.ru"},{"_id":76831,"name":"llmanikur.ru"},{"_id":76386,"name":"ravta.ru"},{"_id":76565,"name":"zdravzona.ru"},{"_id":76567,"name":"kotofoto.ru"},{"_id":76572,"name":"ergotronica.ru"},{"_id":76575,"name":"gardengear.ru"},{"_id":76583,"name":"bosch-shop.ru"},{"_id":76584,"name":"electrolux-shop.ru"},{"_id":76629,"name":"elc-russia.ru"},{"_id":76684,"name":"kocmetix.ru"},{"_id":76747,"name":"21-shop.ru"},{"_id":76836,"name":"stolline.ru"},{"_id":76991,"name":"nazya.com"},{"_id":76993,"name":"newbalance.ru"},{"_id":76994,"name":"svetex.ru"},{"_id":77069,"name":"labirint.ru"},{"_id":77071,"name":"the-alba.com"},{"_id":77074,"name":"lorealprofessionnel.ru"},{"_id":77077,"name":"slamdunk.su"}]');
    ?>
 <section class="product-recommendation">
        <div class="container-main">
            <h2 class="section-title">КОРПОРАЦИЯ ИМИДЖА РЕКОМЕНДУЕТ ВАМ</h2>
            <?php Pjax::begin(['timeout' => 5000]); ?>
            <div class="wrap-product">
                
                <aside class="product-filter">
                    <p class="filter-title">Цвет</p>
                    <ul class="color-list">
                        <?php if ($res['result']['query_colors'] != '') { ?>
                        <?php foreach ($box_color as $key=>$value): ?>
                        <?php if (in_array($key, $cur_colors)):?>
                        <li class="<?=$value ?>">
                            <input type="checkbox" id="<?= $value ?>" data-value="<?= $key ?>">
                            <label for="<?= $value ?>" class="<?= $value ?>"></label>
                        </li>                        
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php } else { ?>
                        <?php foreach ($box_color as $key=>$value): ?>                       
                        <li class="<?=$value ?>">
                            <input type="checkbox" id="<?= $value ?>" data-value="<?= $key ?>">
                            <label for="<?= $value ?>" class="<?= $value ?>"></label>
                        </li>
                        <?php endforeach; ?>
                        <?php } ?>
                    </ul>
                    <p class="filter-title">Производители</p>
                    <ul class="brand-list brand-list-style" >
                        <?php // print_r($merchants[0]->name);die;
                        foreach($merchants as $num=>$merchant):?>
                        <li>
                            <input type="checkbox"  data-value="<?= $merchant->_id; ?>" id="brand_<?= $num; ?>">
                            <label for="brand_<?= $num; ?>" class="seller-label"><?= ($merchant->name)?$merchant->name:''; ?></label>
                        </li>
                        <?php endforeach; ?>
                       
                    </ul>
                    <?php $form = ActiveForm::begin(['id' => 'filter-form', 'action' => ['result', 'test' => $_GET['test']], 'method' => 'get', 'options' => ['data-pjax' => TRUE]]); ?>
                    <?= $form->field($searchModel, 'color[]')->hiddenInput()->label(FALSE); ?>
                    <?= $form->field($searchModel, 'merchant[]')->hiddenInput()->label(FALSE); ?>
                    <button type="submit" class="filter-btn" style="display:inline-block; top:0px;     position: relative;">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             width="20px" height="20px" fill="#fff" viewBox="0 0 402.577 402.577" style="enable-background: #fff;"
                                             xml:space="preserve">
                        <g>
                            <path d="M400.858,11.427c-3.241-7.421-8.85-11.132-16.854-11.136H18.564c-7.993,0-13.61,3.715-16.846,11.136
                                c-3.234,7.801-1.903,14.467,3.999,19.985l140.757,140.753v138.755c0,4.955,1.809,9.232,5.424,12.854l73.085,73.083
                                c3.429,3.614,7.71,5.428,12.851,5.428c2.282,0,4.66-0.479,7.135-1.43c7.426-3.238,11.14-8.851,11.14-16.845V172.166L396.861,31.413
                                C402.765,25.895,404.093,19.231,400.858,11.427z"/>
                        </g>
                    </svg>
                </button>
                    <?php ActiveForm::end(); ?>                      
                </aside>                
                <ul class="product-list">                    
                    <?php foreach ($dataProvider->getModels() as $product) : ?>
                        <li class="product-item">
                            <div class="wrap-img">
                                <?php // print_r($product['original_picture']); die(); ?>
                                <img height="220px" width="170px"src="<?php print_r($product['original_picture']) ; ?>" alt="#">
                                <span class="sale-label">-50%</span>
                                <button type="button" class="add-product-btn"></button>
                            </div>
                            <div class="product-disc">
                                <span class="name"><a href="<?= $product['url']; ?>"><?= $product['name']; ?></a></span>
                                <span class="price"><?= $product['price']; ?> <?= $product['currencyId']; ?>.</span>
                                <span class="old-price">-.</span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
              
            </div>
              <?php 
                    echo LinkPager::widget([
                        'pagination' => $dataProvider->pagination,
                    ]);
                    ?>
                  <?php Pjax::end(); ?>
        </div>
    </section>