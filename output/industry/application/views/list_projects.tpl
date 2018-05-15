<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first active"><a href="projects">Listing</a></li>
                        <li><a href="projects/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
                        <h3>List of {$table_name}</h3>

                        {if !empty( $projects_data )}
                        <form action="projects/delete" method="post" id="listing_form">
                            <table class="table">
                            	<thead>
                                    <th width="20"> </th>
                                    			<th>{$projects_fields.id}</th>
			<th>{$projects_fields.name}</th>
			<th>{$projects_fields.sshy1}</th>
			<th>{$projects_fields.sshy2}</th>
			<th>{$projects_fields.jsdw}</th>
			<th>{$projects_fields.jsdd1}</th><th>{$projects_fields.jsdd2}</th>
			<th>{$projects_fields.tzztxz}</th>
			<th>{$projects_fields.tze}</th>
			<th>{$projects_fields.jsnr}</th>
			<th>{$projects_fields.jjzb}</th>
			<th>{$projects_fields.jssj1}</th>
			<th>{$projects_fields.jssj2}</th>
			<th>{$projects_fields.tags}</th>
			<th>{$projects_fields.xmxz}</th>
			<th>{$projects_fields.ssyq}</th>

                                    <th width="80">Actions</th>
                            	</thead>
                            	<tbody>
                                	{foreach $projects_data as $row}
                                        <tr class="{cycle values='odd,even'}">
                                            <td><input type="checkbox" class="checkbox" name="delete_ids[]" value="{$row.id}" /></td>
                                            				<td>{$row.id}</td>
				<td>{$row.name}</td>
				<td>{$row.sshy1}</td>
				<td>{$row.sshy2}</td>
				<td>{$row.jsdw}</td>
				<td>{$row.jsdd1}</td><td>{$row.jsdd2}</td>
				<td>{$row.tzztxz}</td>
				<td>{$row.tze}</td>
				<td>{$row.jsnr}</td>
				<td>{$row.jjzb}</td>
				<td>{$row.jssj1}</td>
				<td>{$row.jssj2}</td>
				<td>{$row.tags}</td>
				<td>{$row.xmxz}</td>
				<td>{$row.ssyq}</td>

                                            <td width="80">
                                                <a href="projects/show/{$row.id}"><img src="iscaffold/images/view.png" alt="Show record" /></a>
                                                <a href="projects/edit/{$row.id}"><img src="iscaffold/images/edit.png" alt="Edit record" /></a>
                                                <a href="javascript:chk('projects/delete/{$row.id}')"><img src="iscaffold/images/delete.png" alt="Delete record" /></a>
                                            </td>
                            		    </tr>
                                	{/foreach}
                            	</tbody>
                            </table>
                            <div class="actions-bar wat-cf">
                                <div class="actions">
                                    <button class="button" type="submit">
                                        <img src="iscaffold/backend_skins/images/icons/cross.png" alt="Delete"> Delete selected
                                    </button>
                                </div>
                                <div class="pagination">
                                    {$pager}
                                </div>
                            </div>
                        </form>
                        {else}
                            No records found.
                        {/if}

                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
