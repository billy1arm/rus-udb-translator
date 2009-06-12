<div align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="noborder_table">
		<tr>
			<td><a href="{SITE_URL}" title="Домой"><h2>Выбираем таблицу для работы</h2></a></td>
		</tr>
	</table>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td class="td-title-center">Наименование таблицы</td>
			<td class="td-title-center">Строк в переводе</td>
			<td class="td-title-center">Полностью переведено</td>
			<td class="td-title-center">Всего строк</td>
			<td class="td-title-center">% перевода</td>
			<td class="td-title-center">Последний перерасчет</td>
			<td class="td-title-center">Операции</td>
		</tr>
<!-- ARRAY_TABLES_BEGIN -->
		<tr>
			<td class="td-left"><span title="Описание: {DESCRIPTION} Использует данные из {NAME_ORIG_TABLES}">{NAME_TABLES}</span></td>
			<td class="td-right">{TRANSLATE_ROWS}</td>
			<td class="td-right">{FULL_TRANSLATE}</td>
			<td class="td-right">{ALL_ROWS}</td>
			<td class="td-center">{PERCENT_TRANSLATE}</td>
			<td class="td-center">{LAST_RECALCULATE}</td>
			<td class="td-center"><a href="?action=table_view&id={ID_TABLES}" title="Редактирование"><img src="{THEME_URL}images/b_edit.png" alt="Редактирование" width="16" height="16" title="Редактирование" /></a>&nbsp;<a href="?id={ID_TABLES}" onclick="return confirm('Вы уверены?');" title="Пересчитать"><img src="{THEME_URL}images/b_search.png" alt="Пересчитать" width="16" height="16" title="Пересчитать" /></a></td>
		</tr>
<!-- ARRAY_TABLES_END -->
		<tr>
			<td class="td-left"><strong>Итого:</strong></td>
			<td class="td-right"><strong>{TRANSLATE_ROWS}</strong></td>
			<td class="td-right"><strong>{FULL_TRANSLATE}</strong></td>
			<td class="td-right"><strong>{ALL_ROWS}</strong></td>
			<td class="td-center"><strong>{PERCENT_TRANSLATE}</strong></td>
			<td class="td-center">&nbsp;</td>
			<td class="td-center">&nbsp;</td>
		</tr>
	</table>
</div>