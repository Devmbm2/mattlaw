{{include file='modules/ht_formbuilder/include/EditView/footer.tpl'}} 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
  <script src="https://formbuilder.online/assets/js/form-render.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<table width="100%" border="0" cellspacing="1" cellpadding="0" class="edit view">
	 <tr>
		<td scope="row" width="100">
		<div id="build-wrap">
		<input type="hidden" class="randomID" name="ruuid" id="ruuid" value=""/>
    <ul id="tabs"  style="display: none;">
   
    <li id="add-tab-tab"><a href="#new-tab" id="click_it"  >+ tab</a>
    <a type="done"  class="fas fa-check"    onclick="changenamedone(this)"  style="display: none;" ></a>
    <a type="edit"  class="fas fa-edit"    onclick="changename(this)" ></a>
    <a type="close_t"  class="fas fa-times"    onclick="close_t(this)" ></a></li>
  </ul>
  <div id="new-tab"></div>
		</div>
		</td>
	</tr>
</table>

{literal}
<style>
#build-wrap {
  padding: 0;
  margin: 10px 0;
  background: #f2f2f2 url('https://formbuilder.online/assets/img/noise.png');
}
</style>
{/literal}