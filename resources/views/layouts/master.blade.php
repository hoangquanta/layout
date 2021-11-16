<!--
=========================================================
* Soft UI Dashboard PRO - v1.0.4
=========================================================

* Product Page:  https://themes.getbootstrap.com/product/soft-ui-dashboard-pro/ 
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  
  <!-- todo: flexible title -->
  @yield('title')
  {{-- Page specific css --}}
  @yield('assets')
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.4" rel="stylesheet" />
</head>
<body class="g-sidenav-show  bg-gray-100">

  @include('layouts.sidebar')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

    @include('layouts.navbar')

    @yield('content')

    @include('layouts.footer')

  </main>

  @include('layouts.fixed-plugin')

  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  
  <!-- Kanban scripts -->
  <script src="../../assets/js/plugins/dragula/dragula.min.js"></script>
  <script src="../../assets/js/plugins/jkanban/jkanban.js"></script>
  
  <script>
    // jkanban init
    (function() {
      if (document.getElementById("myKanban")) {
        var KanbanTest = new jKanban({
          element: "#myKanban",
          gutter: "10px",
          widthBoard: "450px",
          click: el => {
            let jkanbanInfoModal = document.getElementById("jkanban-info-modal");

            let jkanbanInfoModalTaskId = document.querySelector(
              "#jkanban-info-modal #jkanban-task-id"
            );
            let jkanbanInfoModalTaskTitle = document.querySelector(
              "#jkanban-info-modal #jkanban-task-title"
            );
            let jkanbanInfoModalTaskAssignee = document.querySelector(
              "#jkanban-info-modal #jkanban-task-assignee"
            );
            let jkanbanInfoModalTaskDescription = document.querySelector(
              "#jkanban-info-modal #jkanban-task-description"
            );
            let taskId = el.getAttribute("data-eid");

            let taskTitle = el.querySelector('p.text').innerHTML;
            let taskAssignee = el.getAttribute("data-assignee");
            let taskDescription = el.getAttribute("data-description");
            jkanbanInfoModalTaskId.value = taskId;
            jkanbanInfoModalTaskTitle.value = taskTitle;
            jkanbanInfoModalTaskAssignee.value = taskAssignee;
            jkanbanInfoModalTaskDescription.value = taskDescription;
            var myModal = new bootstrap.Modal(jkanbanInfoModal, {
              show: true
            });
            myModal.show();
          },
          buttonClick: function(el, boardId) {
            if (
              document.querySelector("[data-id='" + boardId + "'] .itemform") ===
              null
            ) {
              // create a form to enter element
              var formItem = document.createElement("form");
              formItem.setAttribute("class", "itemform");
              formItem.innerHTML = `<div class="form-group">
          <textarea class="form-control" rows="2" autofocus></textarea>
          </div>
          <div class="form-group">
              <button type="submit" class="btn bg-gradient-success btn-sm pull-end">Add</button>
              <button type="button" id="kanban-cancel-item" class="btn bg-gradient-light btn-sm pull-end me-2">Cancel</button>
          </div>`;

              KanbanTest.addForm(boardId, formItem);
              formItem.addEventListener("submit", function(e) {
                e.preventDefault();
                var text = e.target[0].value;
                let newTaskId =
                  "_" + text.toLowerCase().replace(/ /g, "_") + boardId;
                KanbanTest.addElement(boardId, {
                  id: newTaskId,
                  title: text,
                  class: ["border-radius-md"]
                });
                formItem.parentNode.removeChild(formItem);
              });
              document.getElementById("kanban-cancel-item").onclick = function() {
                formItem.parentNode.removeChild(formItem);
              };
            }
          },
          addItemButton: true,
          boards: [{
              id: "_backlog",
              title: "Backlog",
              item: [{
                  id: "_task_1_title_id",
                  title: '<p class="text mb-0">Click me to change title</p>',
                  class: ["border-radius-md"]
                },
                {
                  id: "_task_2_title_id",
                  title: '<p class="text mb-0">Drag me to "In progress" section</p>',
                  class: ["border-radius-md"]
                },
                {
                  id: "_task_do_something_id",
                  title: '<img src="../../assets/img/office-dark.jpg" class="w-100"><span class="mt-3 badge badge-sm bg-gradient-primary">Pending</span><p class="text mt-2">Website Design: New cards for blog section and profile details</p><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">3</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland"><img alt="Image placeholder" src="../../assets/img/team-1.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs rounded-circle me-2" data-toggle="tooltip" data-original-title="Audrey Love"><img alt="Image placeholder" src="../../assets/img/team-2.jpg" class="rounded-circle"></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis"><img alt="Image placeholder" src="../../assets/img/team-3.jpg" class="rounded-circle"></a></div></div>',
                  assignee: "Done Joe",
                  description: "This task's description is for something, but not for anything",
                  class: ["border-radius-md"]
                },
              ]
            },
            {
              id: "_progress",
              title: "In progress",
              item: [{
                  id: "_task_3_title_id",
                  title: '<span class="mt-2 badge badge-sm bg-gradient-warning">Errors</span><p class="text mt-2">Fix Firefox errors</p><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">11</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jana Lucie"><img alt="Image placeholder" src="../../assets/img/team-3.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland"><img alt="Image placeholder" src="../../assets/img/team-2.jpg" class=""></a></div></div>',
                  class: ["border-radius-md"]
                },
                {
                  id: "_task_4_title_id",
                  title: '<span class="mt-2 badge badge-sm bg-gradient-info">Updates</span><p class="text mt-2">Argon Dashboard PRO - Angular 11</p><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">3</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jana Lucie"><img alt="Image placeholder" src="../../assets/img/team-5.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland"><img alt="Image placeholder" src="../../assets/img/team-4.jpg" class=""></a></div></div>',
                  class: ["border-radius-md"]
                },
                {
                  id: "_task_do_something_4_id",
                  title: '<img src="../../assets/img/meeting.jpg" class="w-100"><span class="mt-3 badge badge-sm bg-gradient-info">Updates</span><p class="text mt-2">Vue 3 Updates</p><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">9</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland"><img alt="Image placeholder" src="../../assets/img/team-1.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs rounded-circle me-2" data-toggle="tooltip" data-original-title="Audrey Love"><img alt="Image placeholder" src="../../assets/img/team-2.jpg" class="rounded-circle"></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis"><img alt="Image placeholder" src="../../assets/img/team-4.jpg" class="rounded-circle"></a></div></div>',
                  assignee: "Done Joe",
                  description: "This task's description is for something, but not for anything",
                  class: ["border-radius-md"]
                }
              ]

            },
            {
              id: "_working",
              title: "In review",
              item: [{
                  id: "_task_do_something_2_id",
                  title: '<span class="mt-2 badge badge-sm bg-gradient-warning">In Testing</span><p class="text mt-2">Responsive Changes</p><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">11</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jana Lucie"><img alt="Image placeholder" src="../../assets/img/team-3.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland"><img alt="Image placeholder" src="../../assets/img/team-2.jpg" class=""></a></div></div>',
                  assignee: "Done Joe",
                  description: "This task's description is for something, but not for anything",
                  class: ["border-radius-md"]
                },
                {
                  id: "_task_run_id",
                  title: '<span class="mt-2 badge badge-sm bg-gradient-success">In review</span><p class="text mt-2 mb-1">Change images dimension</p><div class="col"><div class="progress progressm mb-3 w5"><div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div></div></div><div class="d-flex"><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland"><img alt="Image placeholder" src="../../assets/img/team-3.jpg" class=""></a></div></div>',
                  assignee: "Done Joe",
                  description: "This task's description is for something, but not for anything",
                  class: ["border-radius-md"]
                },
                {
                  id: "_task_do_something_3_id",
                  title: '<span class="mt-2 badge badge-sm bg-gradient-info">In Review</span><p class="text mt-2 mb-1">Update Links</p><div class="col"><div class="progress progressm mb-3 w5"><div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div></div></div><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">6</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jana Lucie"><img alt="Image placeholder" src="../../assets/img/team-5.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Mike Alis"><img alt="Image placeholder" src="../../assets/img/team-1.jpg" class=""></a></div></div>',
                  assignee: "Done Joe",
                  description: "This task's description is for something, but not for anything",
                  class: ["border-radius-md"]
                }
              ]
            },
            {
              id: "_done",
              title: "Done",
              item: [{
                  id: "_task_all_right_id",
                  title: '<img src="../../assets/img/home-decor-1.jpg" class="w-100"><span class="mt-3 badge badge-sm bg-gradient-success">Done</span><p class="text mt-2">Redesign for the home page</p><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">8</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Jessica Rowland"><img alt="Image placeholder" src="../../assets/img/team-5.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs rounded-circle me-2" data-toggle="tooltip" data-original-title="Audrey Love"><img alt="Image placeholder" src="../../assets/img/team-1.jpg" class="rounded-circle"></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis"><img alt="Image placeholder" src="../../assets/img/team-4.jpg" class="rounded-circle"></a></div></div>',
                  assignee: "Done Joe",
                  description: "This task's description is for something, but not for anything",
                  class: ["border-radius-md"]
                },
                {
                  id: "_task_ok_id",
                  title: '<span class="mt-2 badge badge-sm bg-gradient-success">Done</span><p class="text mt-2">Schedule winter campaign</p><div class="d-flex"><div> <i class="fa fa-paperclip me-1 text-sm"></i><span class="text-sm">2</span></div><div class="avatar-group ms-auto"><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Michael Laurence"><img alt="Image placeholder" src="../../assets/img/team-1.jpg" class=""></a><a href="javascript:;" class="avatar avatar-xs me-2 rounded-circle" data-toggle="tooltip" data-original-title="Michael Lewis"><img alt="Image placeholder" src="../../assets/img/team-4.jpg" class="rounded-circle"></a></div></div>',
                  assignee: "Done Joe",
                  description: "This task's description is for something, but not for anything",
                  class: ["border-radius-md"]
                }
              ]
            }
          ]
        });

        var addBoardDefault = document.getElementById("jkanban-add-new-board");
        addBoardDefault.addEventListener("click", function() {
          let newBoardName = document.getElementById("jkanban-new-board-name")
            .value;
          let newBoardId = "_" + newBoardName.toLowerCase().replace(/ /g, "_");
          KanbanTest.addBoards([{
            id: newBoardId,
            title: newBoardName,
            item: []
          }]);
          document.querySelector('#new-board-modal').classList.remove('show');
          document.querySelector('body').classList.remove('modal-open');

          document.querySelector('.modal-backdrop').remove();
        });

        var updateTask = document.getElementById("jkanban-update-task");
        updateTask.addEventListener("click", function() {
          let jkanbanInfoModalTaskId = document.querySelector(
            "#jkanban-info-modal #jkanban-task-id"
          );
          let jkanbanInfoModalTaskTitle = document.querySelector(
            "#jkanban-info-modal #jkanban-task-title"
          );
          let jkanbanInfoModalTaskAssignee = document.querySelector(
            "#jkanban-info-modal #jkanban-task-assignee"
          );
          let jkanbanInfoModalTaskDescription = document.querySelector(
            "#jkanban-info-modal #jkanban-task-description"
          );
          KanbanTest.replaceElement(jkanbanInfoModalTaskId.value, {
            title: jkanbanInfoModalTaskTitle.value,
            assignee: jkanbanInfoModalTaskAssignee.value,
            description: jkanbanInfoModalTaskDescription.value
          });
          jkanbanInfoModalTaskId.value = jkanbanInfoModalTaskId.value;
          jkanbanInfoModalTaskTitle.value = jkanbanInfoModalTaskTitle.value;
          jkanbanInfoModalTaskAssignee.value = jkanbanInfoModalTaskAssignee.value;
          jkanbanInfoModalTaskDescription.value = jkanbanInfoModalTaskDescription.value;
          document.querySelector('#jkanban-info-modal').classList.remove('show');
          document.querySelector('body').classList.remove('modal-open');
          document.querySelector('.modal-backdrop').remove();


        });
      }
    })();
  </script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../../assets/js/soft-ui-dashboard.min.js?v=1.0.4"></script>
</body>

</html>