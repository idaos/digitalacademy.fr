<?php
/*
Template Name: Page Qui-Sommes-Nous
*/
get_header(); ?>

<?php $bg = '';
if( has_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	$bg = 'style="background-image:url(\''. $url .'\');background-size: cover;background-position:center center"';
}?>
<div class="header" <?php echo $bg; ?>>    
<!--<div class="container-slider main-slider slider-header hidden-xs" style="background-image:url(<?php //the_field('img_dans_les_medias', 'option') ?>)">-->
	<div class="container">
		<div class="row">
			<div class="col-xs-12 alignCenter">
				<h1 class="title-slider">La DigitalAcademy</h1>
				<hr style="display:block">
				<p>Bring Digital Learning to life*</p>
			</div>
		</div>
	</div>
</div>
<div class="svg-wrapper-bottom">
	<svg class="svg-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#eee" points="0,0 0,100 40,40"></polygon>
	</svg>
	<svg class="svg-top" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#bf3b2b" points="0,0 100,20 100,100"></polygon>
	</svg>
	<svg class="svg-back" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
		<polygon fill="#fff" points="0,0 100,100 0,100"></polygon>
	</svg>
</div>    
<div class="container content" style="height:initial;margin-top:-4vw;z-index: 5;">
    <div class="row">
        <div class="col-sm-6" style="padding:1em;text-align:center">
            <iframe src="https://www.youtube.com/embed/FpPAwR5X9Yw" width="584" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            <i style="margin-top:1em">Franck Perrier présente la DigitalAcademy en 30 secondes</i>
            <a class="btn btn-red" href="https://www.youtube.com/channel/UCRRym8ZzrDiyAvVbpjaO1_A?view_as=subscriber">Retrouvez toutes nos vidéos sur YouTube</a>
        </div>
        <div class="col-sm-6">
            <h3 style="text-align:left;">La DigitalAcademy</h3>
            <h2 style="text-align:left;">Un organisme de formations au digital Intra entreprise et des solutions innovantes</h2>
            <hr>
            <p>La DigitalAcademy a été créée en 2010 pour renforcer la culture du digital, les compétences et les performances de vos équipes sur le web en présentiel et ou en distanciel.</p>
            <p>Avec l’évolution des modes d’apprentissage, sous l’impact des technologies digitales, DigitalAcademy a rapidement développé une offre de digital learning pour numériser vos programmes de formation présentiels ou concevoir vos produits de formation digital learning "from scratch".</p>
            <p>Aujourd’hui, notre studio de production conçoit des ressources plus innovantes et plus collaboratives en e-learning, mobile learning, micro-learning à déployer sur des solutions LMS.</p>
            <p>Nos experts « métiers » et pédagogiques développent des réponses adaptées en multimodale selon le périmètre des apprentissages demandés.</p>
            <p>Pour accompagner la transformation, l’acculturation et la montée en expertise de vos organisations et de vos équipes, DigitalAcademy offre donc : des formations en intra ou en inter sur les thématiques du web , une offre complète de conseil et de production pour développer votre offre de formation digitale sur toutes les thématiques « métiers ».</p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="item-gr">
                <img src="https://www.digitalacademy.fr/wp-content/uploads/2020/02/ico-cards.png" alt="" />
                <p>Nos formats sur-mesure vont du coaching de dirigeants aux programmes d’équipes de toutes tailles.</p>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="item-gr">
                <img src="https://www.digitalacademy.fr/wp-content/uploads/2020/02/ico-loc.png" alt="" />
                <span id="team-anchor"></span>
                <p>Nos ingénieries pédagogiques sont adaptées, du présentiel au e-learning en passant par le blended learning.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3>La DigitalAcademy</h3>
            <h2>Une équipe de professionnels de la formation</h2>
            <hr style="margin:auto;margin-bottom:2em;display:block">
        </div>
    </div>
    <div class="row row-same-height team">
        <div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">	<center>
            <div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/franck.png" alt="" /></div>		
            <p class="name"><strong>Franck Perrier</strong></p>
            <p class="fonction">Directeur Conseil / Fondateur de la DigitalAcademy</p>	</center>
        </div>
       <div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">
		<center> <div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/hannah.png" alt="" /></div>
		<p class="name"><strong>Hannah</strong></p>
		<p class="fonction">Developpeur LMS</p>	</center>
		</div><div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">
		<center>            <div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/luis.png" alt="" /></div>		 
		<p class="name"><strong>Luis</strong></p>        
		<p class="fonction">Responsable pédagogie & e-learning</p>	</center>   
		</div>        <div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">	
		<center>            <div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/benjamin.png" alt="" /></div>		
		<p class="name"><strong>Benjamin Ferrier</strong></p>      
		<p class="fonction">Chef de projet formation & Ingénierie pédagogique</p>	
		</center>        </div>  
		<div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">	<center>        
		<div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/charles.png" alt="" /></div>		
		<p class="name"><strong>Charles</strong></p>            <p class="fonction">Chef de projet formation</p>	
		</center>        </div><div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">
		<center>      
		<div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/adrien.png" alt="" /></div>		   
		<p class="name"><strong>Adrien</strong></p>   
		<p class="fonction">Graphiste designer</p>
		</center>    
		</div>      
		<div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">
		<center>       
		<div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/camille.png" alt="" /></div>		
		<p class="name"><strong>Camille</strong></p>      
		<p class="fonction">Production e-learning</p>
		</center>    
		</div>     
		<div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">	
		<center>       
		<div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/jasmine.png" alt="" /></div>		
		<p class="name"><strong>Jasmine</strong></p>      
		<p class="fonction">Consultante Social Media</p>	
		</center>     
		</div><div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">
		<center>       
		<div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/lucas.png" alt="" /></div>		  
		<p class="name"><strong>Lucas</strong></p>     
		<p class="fonction">Developpeur web / Webmaster</p>	</center>    
		</div>   
		<div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">	
		<center>        
		<div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/constant.png" alt="" /></div>	
		<p class="name"><strong>Constant</strong></p>    
        <p class="fonction">Chef de projet web</p>
		</center>   
		</div>    
		<div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">	
		<center>      
		<div class="wrapper"><img src="https://digitalacademy.fr/wp-content/uploads/2022/01/alban.png" alt="" /></div>		
		<p class="name"><strong>Alban</strong></p>       
		<p class="fonction">Production vidéo</p>	
		</center>   
		</div><div class="col-md-4" style="max-width:408px;margin:auto;margin-top:0;margin-bottom:2em;">    
		</div>
<!--
        <div class="col-sm-6 col-md-3">
            <div class="wrapper"><img src="https://www.digitalacademy.fr/wp-content/uploads/2020/02/Bertrand_Anne.jpg" alt="" /></div>
            <p class="name"><strong>Bertrand Anne</strong></p>
            <p class="fonction">Directeur Production / Digital Learning</p>
            <p>Issu du monde des agences web et des startups dans le e-commerce, Bertrand Anne a toujours associé le conseil et la formation dans des logiques opérationnelles.</p>
            <p>Au sein de la DigitalAcademy qu’il a rejoint en 2013, il élabore des ingénieries pédagogiques, écrit et anime des programmes de formation. Il met au service des clients sa connaissance approfondie des médias sociaux, en particulier Facebook, Linkedin et Viadeo, et de la veille / e-réputation.</p>
            <p>Bertrand Anne développe les outils digitaux des formations, de l’usage des plateformes LMS aux outils qui contribuent à digitaliser les programmes : quiz, évaluations en ligne, classes virtuelles.</p>
            <p>Bertrand Anne est diplômé de l’Ecole Supérieure de Commerce de Chambéry avec une spécialité en WebMarketing et de l’Ecole Multimédia de Paris.</p>
        </div>
-->
    </div>
</div>
<?php get_footer(); ?>