<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

    <!-- search form (Optional) -->
    <form class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" ng-model="filtromenu.title"
                   placeholder="{{app.menusearch}}"> <span class="input-group-btn">
				<button type="submit" name="search" id="search-btn"
                        class="btn btn-flat">
					<i class="fa fa-search"></i>
				</button>
			</span>
        </div>
    </form>
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li ng-class="{active: currentview.id == menu.target}"
            ng-repeat="menu in app.menus | filter : filtromenu"><a href="#"
                                                                   ng-click="openView(menu.target)" ui-sref-active="active"> <i
                    class="fa " ng-class="menu.icon"></i> <span>{{menu.title}}</span>
            </a></li>
    </ul>
    <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->

