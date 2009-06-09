<div align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="noborder_table">
		<tr>
			<td><a href="{SITE_URL}" title="Домой">Домой</a></td>
			<td>&raquo;</td>
			<td><a href="{SCRIPT_URL}" title="Работа с таблицей {NAME_ORIG_TABLES}">Работа с таблицей {NAME_TABLES}</a></td>
		</tr>
	</table>
    <br />
	<table border="1" cellspacing="0" cellpadding="0">
		<tr>
			<td class="td-title-left">Строк в переводе</td>
			<td class="td-right">{TRANSLATE_ROWS}</td>
		</tr>
		<tr>
			<td class="td-title-left">Полностью переведено</td>
			<td class="td-right">{FULL_TRANSLATE}</td>
		</tr>
		<tr>
			<td class="td-title-left">Всего строк</td>
			<td class="td-right">{ALL_ROWS}</td>
		</tr>
		<tr>
			<td class="td-title-left">% перевода</td>
			<td class="td-right">{PERCENT_TRANSLATE}</td>
		</tr>
		<tr>
			<td class="td-title-left">Последний перерасчет</td>
			<td class="td-right">{LAST_RECALCULATE}</td>
		</tr>
	</table>
	<br />
	<table cellspacing="0" border="0" cellpadding="0" class="noborder_table">
		<tr>
			<td>
<!-- IF_TABLE_NEW_BEGIN -->
				<a href="?action=table_new&id={ID_TABLES}" title="Непереведенные"><img src="{THEME_URL}images/b_tblimport.png" alt="Непереведенные" width="16" height="16" title="Непереведенные" /></a>
<!-- IF_TABLE_NEW_END -->
<!-- IF_TABLE_PARTIALLY_BEGIN -->
				<a href="?action=table_partially&id={ID_TABLES}" title="Частично переведенные"><img src="{THEME_URL}images/b_unique.png" alt="Частично переведенные" width="16" height="16" title="Частично переведенные" /></a>
<!-- IF_TABLE_PARTIALLY_END -->
<!-- IF_TABLE_TRANSLATED_BEGIN -->
				<a href="?action=table_translated&id={ID_TABLES}" title="Переведенные"><img src="{THEME_URL}images/b_ftext.png" alt="Переведенные" width="16" height="16" title="Переведенные" /></a>
<!-- IF_TABLE_TRANSLATED_END -->
<!-- IF_TABLE_EXPORT_BEGIN -->
				<a href="?action=table_export&id={ID_TABLES}" title="Экспорт таблицы"><img src="{THEME_URL}images/b_tblexport.png" alt="Экспорт таблиц" width="16" height="16" title="Экспорт таблиц" /></a>
<!-- IF_TABLE_EXPORT_END -->
			</td>
		</tr>
	</table>
</div>