const $ = jQuery

export var metaboxRepiterFields = function() {

	$("body").find(".cltvo_repiter_JS").each(function(repiter){

		var repiter_id 					= this.id,
			$repiter					= $(this),
			add_button_selector 		= '.'+repiter_id+'-add_JS',
			delete_button_selector 		= '.'+repiter_id+'-delete_JS',
			input_selector				= '.'+repiter_id+'-input_JS',
			contact_selector			= '.'+repiter_id+'-row_JS',
			contact_container_selector	= '.'+repiter_id+'-table_JS',
			template_selector			= '#'+repiter_id+'-template'
			;

		console.log("repiter "+repiter_id+' found' );
		$repiter.on("click", add_button_selector , function(){

			var $template 				= $(template_selector) ,
				$container 				= $(contact_container_selector),
				$template_clone  		= $template.clone(),
				next_key				= 0;

			$container.find(contact_selector).each(function(){
				var current_key = parseInt($(this).attr("data-row-key"));
				next_key = next_key < current_key ? current_key : next_key;
			});

			$template_clone.find(input_selector).each(function(){
				$(this).prop("disabled",false);
				$(this).addClass('.i18n-multilingual');

				if (qTranslateConfig != undefined) {
					qTranslateConfig.qtx.addContentHook(this,'[');
				}
			});

			$container.append( $template_clone.html().replace(/__next-key__/g, next_key+1) );

			if (qTranslateConfig != undefined) {
				$container.find(input_selector).each(function(){
					qTranslateConfig.qtx.removeContentHook(this);
					qTranslateConfig.qtx.addContentHook(this,'[');
				})
			}

		});

		$repiter.on("click", delete_button_selector , function(){
			var $this = $(this);

			$this.closest(contact_selector).remove();
		});
	});
};

export const  initializeRepiters = () => {
	jQuery(document).ready(function($){
		metaboxRepiterFields();
	});
}
