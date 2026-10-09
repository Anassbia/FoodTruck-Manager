
function initializeDataTable_admin() {
        let t = document.querySelector(".datatables-admin"),
            r = "app-user-view-account.html",
            n = { 1: { title: "Active", class: "bg-label-success" }, 2: { title: "Inactive", class: "bg-label-danger" } },
            a = $(".select2"),
            s;
            let Data = new DataTable(t, {
                ajax: {
                    url: "/getAdmin",
                    type: "GET",
                    dataSrc: "data", // Ensure DataTables gets data from `data` key
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                    }
                },
                
                columns: [{ data: "id" }, { data: "id", orderable: !1, render: DataTable.render.select() }, { data: "first_name" }, { data: "role" },{ data: "status" },{ data: null }],
                columnDefs: [
                    {
                        className: "control",
                        searchable: !1,
                        orderable: !1,
                        responsivePriority: 2,
                        targets: 0,
                        render: function (e, t, a, s) {
                            return "";
                        },
                    },
                    {
                        targets: 1,
                        orderable: !1,
                        searchable: !1,
                        responsivePriority: 4,
                        checkboxes: !0,
                        checkboxes: { selectAllRender: '<input type="checkbox" class="form-check-input">' },
                        render: function () {
                            return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                        },
                    },
                    {
                        targets: 2,
                        responsivePriority: 3,
                        render: function (e, t, a, s) {
                            
                             
                                return (
                                    '<div class="d-flex justify-content-start align-items-center user-name"><div class="avatar-wrapper"><div class="avatar avatar-sm me-4">' +
                                    (a.image
                                        ? '<img src="' + assetsPath + "img/avatars/" + a.image + '" alt="Avatar" class="rounded-circle">'
                                        : '<span class="avatar-initial rounded-circle bg-label-' +
                                          ["success", "danger", "warning", "info", "dark", "primary", "secondary"][Math.floor(6 * Math.random())] +
                                          '">' +
                                          (a.first_name.charAt(0).toUpperCase() || "") + (a.last_name.charAt(0).toUpperCase() || "") +
                                          "</span>") +
                                    '</div></div><div class="d-flex flex-column"><a href="' +
                                    r +
                                    '" class="text-heading text-truncate"><span class="fw-medium">' +
                                    a.first_name + ' '+a.last_name+
                                    "</span></a><small>" +
                                    a.email +
                                    "</small></div></div>"
                                );
                        },
                    },
                    {
                        targets: 3,
                        render: function (e, t, a, s) {
                            a = a.role;
                            return (
                                "<span class='text-truncate d-flex align-items-center text-heading'>" +
                                ({
                                    Subscriber: '<i class="icon-base bx bx-crown text-primary me-2"></i>',
                                    Author: '<i class="icon-base bx bx-edit text-warning me-2"></i>',
                                    Maintainer: '<i class="icon-base bx bx-user text-success me-2"></i>',
                                    Editor: '<i class="icon-base bx bx-pie-chart-alt text-info me-2"></i>',
                                    Admin: '<i class="icon-base bx bx-desktop text-danger me-2"></i>',
                                }[a] || "") +
                                a +
                                "</span>"
                            );
                        },
                    },
                
                    {
                        targets: 4,
                        render: function (e, t, a, s) {
                            a = a.status;
                            return '<span class="badge ' + n[a].class + '" text-capitalized>' + n[a].title + "</span>";
                        },
                    },
                    {
                        targets: 5,
                        title: "Actions",
                        searchable: !1,
                        orderable: !1,
                        render: (e, t, a, s) => `
                  <div class="d-flex align-items-center">
                    <a href="javascript:;" class="btn btn-icon delete-admin" data-id="${a.id_admin}" alert="Delete:Admin" url="/admin/delete/:DELETE">
                        <i class="icon-base bx bx-trash icon-md"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon edit-admin" data-id="${a.id_admin}" data-bs-toggle="modal" data-bs-target="#basicModal">
                        <i class="icon-base bx bx-edit icon-md"></i>
                    </a>

                  </div>
                `,
                    },
                ],
                select: { style: "multi", selector: "td:nth-child(2)" },
                order: [[2, "desc"]],
                layout: {
                    topStart: { rowClass: "row mx-3 my-0 justify-content-between", features: [{ pageLength: { menu: [10, 25, 50, 100], text: "_MENU_" } }] },
                    topEnd: {
                        features: [
                            { search: { placeholder: "Search Admin", text: "_INPUT_" } },
                           
                        ],
                    },
                    bottomStart: { rowClass: "row mx-3 justify-content-between", features: ["info"] },
                    bottomEnd: { paging: { firstLast: !1 } },
                },
                language: {
                    sLengthMenu: "_MENU_",
                    search: "",
                    searchPlaceholder: "Search User",
                    paginate: { next: '<i class="icon-base bx bx-chevron-right icon-18px"></i>', previous: '<i class="icon-base bx bx-chevron-left icon-18px"></i>' },
                },
                responsive: {
                    details: {
                        display: DataTable.Responsive.display.modal({
                            header: function (e) {
                                return "Details of " + e.data().full_name;
                            },
                        }),
                        type: "column",
                        renderer: function (e, t, a) {
                            var s,
                                n,
                                o,
                                a = a
                                    .map(function (e) {
                                        return "" !== e.title
                                            ? `<tr data-dt-row="${e.rowIndex}" data-dt-column="${e.columnIndex}">
                          <td>${e.title}:</td>
                          <td>${e.data}</td>
                        </tr>`
                                            : "";
                                    })
                                    .join("");
                            return (
                                !!a &&
                                ((s = document.createElement("div")).classList.add("table-responsive"),
                                (n = document.createElement("table")),
                                s.appendChild(n),
                                n.classList.add("table"),
                                ((o = document.createElement("tbody")).innerHTML = a),
                                n.appendChild(o),
                                s)
                            );
                        },
                    },
                },
                initComplete: function () {
                    let r = this.api();
                    var e = (e, t, a, s) => {
                        let n = r.column(e),
                            o = document.createElement("select");
                        (o.id = a),
                            (o.className = "form-select text-capitalize"),
                            (o.innerHTML = `<option value="">${s}</option>`),
                            document.querySelector(t).appendChild(o),
                            o.addEventListener("change", () => {
                                var e = o.value ? `^${o.value}$` : "";
                                n.search(e, !0, !1).draw();
                            }),
                            Array.from(new Set(n.data().toArray()))
                                .sort()
                                .forEach((e) => {
                                    var t = document.createElement("option");
                                    (t.value = e), (t.textContent = e), o.appendChild(t);
                                });
                    };
                    e(3, ".user_role", "UserRole", "Select role");
                    let a = document.createElement("select");
                    (a.id = "FilterTransaction"),
                        (a.className = "form-select text-capitalize"),
                        (a.innerHTML = '<option value="">Select Status</option>'),
                        document.querySelector(".user_status").appendChild(a),
                        a.addEventListener("change", () => {
                            var e = a.value ? `^${a.value}$` : "";
                            r.column(4).search(e, !0, !1).draw();
                        });
                    e = r.column(4);
                    Array.from(new Set(e.data().toArray()))
                        .sort()
                        .forEach((e) => {
                            var t = document.createElement("option");
                            (t.value = n[e]?.title || e), (t.textContent = n[e]?.title || e), (t.className = "text-capitalize"), a.appendChild(t);
                        });
                },
            });
            function o(e) {
                let t = document.querySelector(".dtr-expanded");
                (t = e ? e.target.parentElement.closest("tr") : t) && a.row(t).remove().draw();
            }
            function l() {
                var e = document.querySelector(".datatables-admin");
                let t = document.querySelector(".dtr-bs-modal");
                e && e.classList.contains("collapsed")
                    ? t &&
                      t.addEventListener("click", function (e) {
                          e.target.parentElement.classList.contains("delete-record") && (o(), (e = t.querySelector(".btn-close"))) && e.click();
                      })
                    : (e = e?.querySelector("tbody")) &&
                      e.addEventListener("click", function (e) {
                          e.target.parentElement.classList.contains("delete-record") && o(e);
                      });
            }
            l(),
                document.addEventListener("show.bs.modal", function (e) {
                    e.target.classList.contains("dtr-bs-modal") && l();
                }),
                document.addEventListener("hide.bs.modal", function (e) {
                    e.target.classList.contains("dtr-bs-modal") && l();
                }),
                $(".dt-buttons > .btn-group > button").removeClass("btn-secondary");
        
        setTimeout(() => {
            [
                { selector: ".dt-buttons .btn", classToRemove: "btn-secondary" },
                { selector: ".dt-search .form-control", classToRemove: "form-control-sm" },
                { selector: ".dt-length .form-select", classToRemove: "form-select-sm", classToAdd: "ms-0" },
                { selector: ".dt-length", classToAdd: "mb-md-6 mb-0" },
                { selector: ".dt-search", classToAdd: "mb-md-6 mb-2" },
                { selector: ".dt-layout-end", classToRemove: "justify-content-between", classToAdd: "d-flex gap-md-4 justify-content-md-between justify-content-center gap-4 flex-wrap mt-0" },
                { selector: ".dt-layout-start", classToAdd: "mt-0" },
                { selector: ".dt-buttons", classToAdd: "d-flex gap-4 mb-md-0 mb-6" },
                { selector: ".dt-layout-table", classToRemove: "row mt-2" },
                { selector: ".dt-layout-full", classToRemove: "col-md col-12", classToAdd: "table-responsive" },
            ].forEach(({ selector: e, classToRemove: a, classToAdd: s }) => {
                document.querySelectorAll(e).forEach((t) => {
                    a && a.split(" ").forEach((e) => t.classList.remove(e)), s && s.split(" ").forEach((e) => t.classList.add(e));
                });
            });
        }, 100);

        $(document).off("click", ".edit-admin").on("click", ".edit-admin", function () {
            debugger;
            let table = $(".datatables-admin").DataTable();
            let adminId = $(this).data("id");
            console.log(adminId);
            
        
            // Find user details from DataTable
            let admin = table
                .rows()
                .data()
                .toArray()
                .find((u) => u.id_admin == adminId);
        
            if (admin) {
                // Populate form fields
                $(".modal-title").text('Admin ' + admin.first_name + ' ' + admin.last_name);
                $("#username").val(admin.username);
                $("#password").val(admin.password);
                $("#conf_password").val(admin.password);
                $("#status").val(admin.status);
                $("#role").val(admin.id_role);
                $("#updateUser").find("button[name ='api']").attr("url", "/admin/update/" + admin.id_admin + ":PUT");
            }
        });

        $(document).off("click", ".delete-admin").on("click", ".delete-admin", function () {

            var adminId = $(this).data('id');
            var route = $(this).attr('url');
            var alert = $(this).attr('alert');            
            
            AjaxFunction(adminId, route, alert);
            
        });


        $(document).on("Data", function () {
            Data.ajax.reload(null, false);
        });


       
      };
      