<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="industry">Listing</a></li>
                        <li><a href="industry/create/">New record</a></li>
                    </ul>
                </div>

                <div class="content">
                    <div class="inner">
						<h3>Details of {$table_name}, record #{$id}</h3>

						<table class="table" width="50%">
                        	<thead>
                                <th width="20%">Field</th>
                                <th>Value</th>
                        	</thead>
						    <tr class="{cycle values='odd,even'}">
                            <td>{$industry_fields.id}:</td>
                            <td>{$industry_data.id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$industry_fields.name}:</td>
                            <td>{$industry_data.name}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$industry_fields.parentid}:</td>
                            <td>{$industry_data.parentid}</td>
                        </tr>
						</table>
                        <div class="actions-bar wat-cf">
                            <div class="actions">
                                <a class="button" href="industry/edit/{$id}">
                                    <img src="iscaffold/backend_skins/images/icons/application_edit.png" alt="Edit record"> Edit record
                                </a>
                            </div>
                        </div>
                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
