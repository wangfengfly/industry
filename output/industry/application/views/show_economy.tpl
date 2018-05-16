<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="economy">Listing</a></li>
                        <li><a href="economy/create/">New record</a></li>
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
                            <td>{$economy_fields.id}:</td>
                            <td>{$economy_data.id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.park_id}:</td>
                            <td>{$economy_data.park_id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.year}:</td>
                            <td>{$economy_data.year}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.pepole_count}:</td>
                            <td>{$economy_data.pepole_count}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.gross}:</td>
                            <td>{$economy_data.gross}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.delivery}:</td>
                            <td>{$economy_data.delivery}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.total_assets}:</td>
                            <td>{$economy_data.total_assets}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.current_assets}:</td>
                            <td>{$economy_data.current_assets}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.debt}:</td>
                            <td>{$economy_data.debt}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.owners}:</td>
                            <td>{$economy_data.owners}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.revenue}:</td>
                            <td>{$economy_data.revenue}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.profit}:</td>
                            <td>{$economy_data.profit}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.tax}:</td>
                            <td>{$economy_data.tax}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$economy_fields.loss}:</td>
                            <td>{$economy_data.loss}</td>
                        </tr>
						</table>
                        <div class="actions-bar wat-cf">
                            <div class="actions">
                                <a class="button" href="economy/edit/{$id}">
                                    <img src="iscaffold/backend_skins/images/icons/application_edit.png" alt="Edit record"> Edit record
                                </a>
                            </div>
                        </div>
                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
