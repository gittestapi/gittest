<?php

/* @var $this yii\web\View */

$this->title = 'GitTest.com -- Manage your tests in GitHub';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You are welcome to manage your tests in GitHub using GitTest.</p>
		<div style="float:left;">
        <div style="padding-left:250px;float:left;"><a class="btn btn-lg btn-success" href="http://www.gittest.com/doc">Read the guide</a></div>
		<div style="padding-left:60px;float:left;"><a class="btn btn-lg btn-info" href="http://www.gittest.com/doc">Start a GitTest</a></div>
		</div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <h2>Create Project/Repo</h2>

                <p>Now you can create project/repo in GitTest to manage your team's test, here we go!</p>

                <p><a class="btn btn-default" href="/index.php?r=repo%2Fcreate">New Project/Repo &raquo;</a></p>
		<p><a class="btn btn-default" href="/index.php?r=repo%2Findex">My Project/Repo &raquo;</a></p>
		<p><a class="btn btn-default" href="/index.php?r=repo%2Findexall">All Project/Repo &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Create Test Case</h2>

                <p>Now you can create test cases in GitTest to manage your team's test, here we go!</p>

                <p><a class="btn btn-default" href="/index.php?r=test-case%2Fcreate">New Test Cases &raquo;</a></p>
		<p><a class="btn btn-default" href="/index.php?r=test-case%2Findex">My Test Cases &raquo;</a></p>
            </div>
	    <div class="col-lg-3">
                <h2>Create Test Plan</h2>

                <p>Now you can create test plan in GitTest to manage your team's test, here we go!</p>

                <p><a class="btn btn-default" href="/index.php?r=test-excution%2Fcreate">New Test Plan &raquo;</a></p>
		<p><a class="btn btn-default" href="/index.php?r=test-excution%2Findex">My Test Plan &raquo;</a></p>
            </div>
            <div class="col-lg-3">
                    <h2>我的测试任务</h2>

                    <p>我作为Tester应该执行的测试任务</p>
    		<p><a class="btn btn-default" href="/index.php?r=test-excution%2Fmy-missions">我的测试任务 &raquo;</a></p>
                </div>
        </div>

    </div>
</div>
