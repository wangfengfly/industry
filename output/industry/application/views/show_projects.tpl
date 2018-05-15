<div class="block" id="block-tables">

                <div class="secondary-navigation">
                    <ul class="wat-cf">
                        <li class="first"><a href="projects">Listing</a></li>
                        <li><a href="projects/create/">New record</a></li>
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
                            <td>{$projects_fields.id}:</td>
                            <td>{$projects_data.id}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.name}:</td>
                            <td>{$projects_data.name}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.sshy1}:</td>
                            <td>{$projects_data.sshy1}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.sshy2}:</td>
                            <td>{$projects_data.sshy2}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.jsdw}:</td>
                            <td>{$projects_data.jsdw}</td>
                        </tr>
                            <tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.jsdd1}:</td>
                            <td>{$projects_data.jsdd1}</td>
                        </tr>
                            <tr class="{cycle values='odd,even'}">
                                <td>{$projects_fields.jsdd2}:</td>
                                <td>{$projects_data.jsdd2}</td>
                            </tr>
                            <tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.tzztxz}:</td>
                            <td>{$projects_data.tzztxz}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.tze}:</td>
                            <td>{$projects_data.tze}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.jsnr}:</td>
                            <td>{$projects_data.jsnr}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.jjzb}:</td>
                            <td>{$projects_data.jjzb}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.jssj1}:</td>
                            <td>{$projects_data.jssj1}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.jssj2}:</td>
                            <td>{$projects_data.jssj2}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.tags}:</td>
                            <td>{$projects_data.tags}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.xmxz}:</td>
                            <td>{$projects_data.xmxz}</td>
                        </tr><tr class="{cycle values='odd,even'}">
                            <td>{$projects_fields.ssyq}:</td>
                            <td>{$projects_data.ssyq}</td>
                        </tr>
						</table>
                        <div class="actions-bar wat-cf">
                            <div class="actions">
                                <a class="button" href="projects/edit/{$id}">
                                    <img src="iscaffold/backend_skins/images/icons/application_edit.png" alt="Edit record"> Edit record
                                </a>
                            </div>
                        </div>
                    </div><!-- .inner -->
                </div><!-- .content -->
            </div><!-- .block -->
