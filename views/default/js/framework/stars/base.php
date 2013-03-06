<?php if (FALSE) : ?>
	<script type="text/javascript">
<?php endif; ?>

	elgg.provide('framework');
	elgg.provide('framework.starrating');

	framework.starrating.init = function() {
		$('.hj-ajaxed-starrating:not([rel=stars])')
		.each(function() {
				framework.starrating.addStars($(this));
		})
	}

	framework.starrating.addStars = function($elem) {
			var caption = $elem.next('div.hj-starrating-caption');
			caption.show();
			$elem.stars({
				inputType: "select",
				oneVoteOnly: true,
				callback: function(ui, type, value) {
					elgg.action($elem.attr('action'), {
						data : {
							starrating : value
						},
						beforeSend : function() {
							elgg.system_message(elgg.echo('hj:starrating:saving'));
						},
						success : function(output) {

							var data = output.output,
							average_value = data.average_value,
							stats = data.stats;

							ui.select(average_value);
							caption.text(stats);
						}
					});
				}
			});
			$elem.attr('rel', 'stars');
	}

	elgg.register_hook_handler('init', 'system', framework.starrating.init);
	elgg.register_hook_handler('ajax:success', 'framework', framework.starrating.init);

<?php if (FALSE) : ?></script><?php endif; ?>