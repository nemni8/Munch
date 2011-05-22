<div id="footer">
	<div id="inner_footer" align="center" class="">
		<h2>
			Final Project - Munch<br/>
			Submitters: Kobi Nemni & Omry Oz - June 2011<br/>
			<span id="abstract">Click Here To Read The Abstract</span>
		</h2>
	</div>
	<div id="form_dialog_rest" title="Restaurant Details"></div>
    <div id="form_dialog_user" title="User Details"></div>
	<div id="form_dialog_category" title="Category Details"></div>
    <div id="form_dialog_ingredient" title="Ingredient Details"></div>
	<div id="form_dialog_dish" title="Dish Details"></div>
	<div id="form_dialog_group" title="Group Details"></div>
    <div id="form_dialog_delete" title="Delete Confirmation"></div>
	<div id="abstract_con_div" title="Abstract">
		<p>
			When a small restaurant wants to sell online it faces two options: The first is to build and maintain its own website – which is quite expensive. The Second option is to upload its menu unto a central website that provides such services to a variety of restaurants. The latter option is more realistic for a small restaurant interested in selling online.<br/><br/>
			Today, websites offering those services do not offer the restaurant's menus management options. Rather, customer restaurants should contact the webmaster for menu updates. Moreover, these websites do not provide sales statistics to their customer restaurants, and food order customization is quite limited.<br/><br/>
			The project's goal is to build a prototype of a system that provides online food ordering services to restaurants, which can be self managed by the restaurant customers, and offers flexibility to the ordering customers.  In addition, the system's database will enable future implementation of BI tools (beyond the project scope).<br/><br/>
			At the beginning of the project we surveyed the literature about the importance of information systems in SMEs and examined the influence of online business. In addition, in order to fully understand the user (restaurants and customers) requirements we preformed a market survey, where we examined websites of companies who offer similar services, conducted informal interviews with restaurant owners and customers who use online food ordering.<br/><br/>
			The system was built using the open source "Kohana" framework for PHP combined with MySQL database. The technology was chosen mainly because of the professional experience of the system developers. The system was built using the agile methodology and included two "sprints". The first sprint focused on the planning and development of the Administration module, allowing restaurants to manage their menus and business rules. The second sprint focused on planning and developing the food ordering module, where customers can order food from various restaurants using filtering criteria such as: kosher, location etc., and then flexibly order their favorite dishes.<br/><br/>
			The prototype development was completed and it meets the primary defined functionalities, as well as allowing for future enhancements, for example smoothly adding BI tools.
		</p>
	</div>
	<?php echo Form::input('id_of_rest',0,array('id'=>'id_of_rest','type'=>'hidden'));?>
    <?php echo Form::input('id_of_user',0,array('id'=>'id_of_user','type'=>'hidden'));?>
	<?php echo Form::input('id_of_category',0,array('id'=>'id_of_category','type'=>'hidden'));?>
    <?php echo Form::input('id_of_ingredient',0,array('id'=>'id_of_ingredient','type'=>'hidden'));?>
	<?php echo Form::input('id_of_dish',0,array('id'=>'id_of_dish','type'=>'hidden'));?>
	<?php echo Form::input('id_of_group',0,array('id'=>'id_of_group','type'=>'hidden'));?>
    <?php echo Form::input('id_of_source',0,array('id'=>'id_of_source','type'=>'hidden'));?>
    <?php echo Form::input('id_for_delete',0,array('id'=>'id_for_delete','type'=>'hidden'));?>
</div>