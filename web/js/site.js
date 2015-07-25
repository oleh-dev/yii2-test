$( document ).ready(function() {
    $('#add-item').click(function (e){
		e.preventDefault();

		last_id = $('.row-edit:last').data('id');
		new_id = last_id+1;
		var order_id = $('#w0').data('order');
		$el = $('<div class="row-edit dyn" id="row'+new_id+'" data-id="'+new_id+'"></div>');
		$el.append('<div class="form-group ></div>');
		$el.append('<div class="form-group field-model-'+new_id+'-order_id"><input type="hidden" value="'+order_id+'" name="Model['+new_id+'][order_id]" class="form-control" id="model-'+new_id+'-order_id"><div class="help-block"></div></div>');
		$el.append('<div class="form-group field-model-'+new_id+'-price required"><input type="text" value="" name="Model['+new_id+'][price]" class="form-control" id="model-'+new_id+'-price"><div class="help-block"></div></div>');
		$el.append('<div class="form-group field-model-'+new_id+'-description required"><input type="text" maxlength="255" value="" name="Model['+new_id+'][description]" class="form-control" id="model-'+new_id+'-description"><div class="help-block"></div></div>');
		$el.append('<div class="form-group field-model-'+new_id+'-available"><input type="hidden" value="0" name="Model['+new_id+'][available]"><label><input type="checkbox" value="1" name="Model['+new_id+'][available]" id="model-'+new_id+'-available"> </label><div class="help-block"></div></div>');
		$el.append('<a data-id="'+new_id+'" class="btn btn-default remove-item">-</a>');

		$('#end-form').before($el);
		

		obj = $('#w0').yiiActiveForm('find', 'model-'+last_id+'-price');

		$('#w0').yiiActiveForm('add', {
			'id': 'model-'+new_id+'-price',
			'name': '['+new_id+'][price]',
			'container': '.field-model-'+new_id+'-price',  //'.field-address',
			'input': '#model-'+new_id+'-price',
			'error': '.help-block',
			'validate': obj.validate
		});

		obj = $('#w0').yiiActiveForm('find', 'model-'+last_id+'-description');

		$('#w0').yiiActiveForm('add', {
			'id': 'model-'+new_id+'-description',
			'name': '['+new_id+'][description]',
			'container': '.field-model-'+new_id+'-description',  //'.field-address',
			'input': '#model-'+new_id+'-description',
			'error': '.help-block',
			'validate': obj.validate
		});
		
	});
	
	$(document).on('click', '.remove-item', function (e) {
		e.preventDefault();
		if ( $('#w0 > div[id^=row]').length > 1)
			$('#row'+$(this).data('id')).remove();
		
	});
});