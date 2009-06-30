<div align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="noborder_table">
		<tr>
			<td><a href="{SITE_URL}" title="Домой">Домой</a></td>
			<td>&nbsp;&raquo;&nbsp;</td>
			<td><a href="{TABLE_URL}" title="Работа с таблицей {NAME_ORIG_TABLES}">Работа с таблицей {NAME_TABLES}</a></td>
			<td>&nbsp;&raquo;&nbsp;</td>
			<td><a href="{SCRIPT_URL}" title="Работа с строкой &acute;{NAME_ORIG_INDEX}&acute; = {ID_ROW}">Работа с строкой &acute;{NAME_RUS_INDEX}&acute; = {ID_ROW}</a></td>
		</tr>
	</table>
<!-- IF_WOWHEAD_URL_BEGIN -->
    <br />
	<table border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td class="td-title-center">&nbsp;Ссылка на Wowhead (Английский)&nbsp;</td>
			<td class="td-title-center">&nbsp;Ссылка на Wowhead (Русский)&nbsp;</td>
		</tr>
		<tr>
			<td class="td-center">&nbsp;<a href="{URL_WOWHEAD_ORIG}" title="Ссылка на Wowhead (Английский)" target="_blank">{URL_WOWHEAD_ORIG}</a>&nbsp;</td>
			<td class="td-center">&nbsp;<a href="{URL_WOWHEAD_RUS}" title="Ссылка на Wowhead (Русский)" target="_blank">{URL_WOWHEAD_RUS}</a>&nbsp;</td>
		</tr>
	</table>
<!-- IF_WOWHEAD_URL_END -->
	<br />
    <form name="new" method="post" action="{SCRIPT_URL}&save=true">
		<table border="0" cellspacing="0" cellpadding="0" class="noborder_table">
			<tr>
				<td class="td-title-center">Название поля</td>
				<td class="td-title-center">Текст в оригинале</td>
				<td class="td-title-center">Текст в переводе</td>
			</tr>
<!-- ARRAY_FIELD_BEGIN -->
			<tr>
				<td class="td-left"><span title="Описание: {DESCRIPTION} Оригинал: {NAME_OF_ORIG_FIELD}">{NAME_OF_RUS_FIELD}</span></td>
				<td class="td-center"><textarea name="text_of_{NAME_OF_ORIG_FIELD}" cols="40" rows="5" readonly="readonly" id="text_of_orig" class="textinput">{TEXT_OF_ORIG}</textarea></td>
				<td class="td-center"><textarea name="text_of_{NAME_OF_RUS_FIELD}" id="text_of_rus" <!-- IF_SAVED_BEGIN -->readonly="readonly" <!-- IF_SAVED_END -->cols="40" rows="5" class="textinput">{TEXT_OF_RUS}</textarea></td>
			</tr>
<!-- ARRAY_FIELD_END -->
		</table>
<!-- IF_NOT_SAVED_BEGIN -->
        <br />
		<table border="0" cellspacing="0" cellpadding="0" class="noborder_table">
			<tr>
				<td class="td-title-center"><input name="saved" type="checkbox" value="saved" />Закончить перевод строки?</td>
			</tr>
			<tr>
				<td class="td-title-center"><input name="save" type="submit" value="Сохранить" /></td>
			</tr>
		</table>
<!-- IF_NOT_SAVED_END -->
    </form>
</div>