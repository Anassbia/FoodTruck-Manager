
function initializeDataTable_menu() {
        let t = document.querySelector(".datatables-menu"),
            r = "app-user-view-account.html",
            n = { 1: { title: "Active", class: "bg-label-success" }, 2: { title: "Inactive", class: "bg-label-danger" } },
            a = $(".select2"),
            s;
            let Data = new DataTable(t, {
                ajax: {
                    url: "/getMenu",
                    type: "GET",
                    dataSrc: "data",
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText);
                    }
                },
                
                columns: [{ data: "id_menu" }, { data: "id_menu", orderable: !1, render: DataTable.render.select() }, { data: "name" }, { data: "type" }, { data: "price" }, { data: "reduction" },{ data: "status" },{ data: null }],
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
                                    ? '<img src="/storage/' + a.image + '" alt="Avatar" class="rounded-circle" style="object-fit: cover;" width="40" height="40">'
                                    : '<span class="avatar-initial rounded-circle bg-label-' +
                                      ["success", "danger", "warning", "info", "dark", "primary", "secondary"][Math.floor(6 * Math.random())] +
                                      '">' +
                                      /* (a.first_name.charAt(0).toUpperCase() || "") + (a.last_name.charAt(0).toUpperCase() || "") + */
                                      "</span>") +
                                '</div></div><div class="d-flex flex-column"><a href="' +
                                r +
                                '" class="text-heading text-truncate"><span class="fw-medium">' +
                                a.name +
                                "</span></a><small>" +
                                a.type +
                                "</small></div></div>"
                            );
                        },
                    },
                    {
                        targets: 3,
                        render: function (e, t, a, s) {
                           
                            return '<span class="text-heading">' + a.type + "</span>";

                        },
                    },
                    {
                        targets: 4,
                        render: function (e, t, a, s) {
                         
                            return '<span class="text-heading">' + a.price +' DH'+ "</span>";

                        }
                    },
                    
                    {
                        targets: 5,
                        render: function (e, t, a, s) {
                            return '<span class="text-heading">' + a.reduction +'%'+ "</span>";
                        }
                    },
                
                    {
                        targets: 6,
                        render: function (e, t, a, s) {
                            a = a.status;
                            return '<span class="badge ' + n[a].class + '" text-capitalized>' + n[a].title + "</span>";
                        },
                    },
                    {
                        targets: 7,
                        title: "Actions",
                        searchable: !1,
                        orderable: !1,
                        render: (e, t, a, s) => `
                  <div class="d-flex align-items-center">
                    <a href="javascript:;" class="btn btn-icon delete-menu" data-id="${a.id_menu}" alert="Delete:Menu" url="/menu/delete/:DELETE">
                      <i class="icon-base bx bx-trash icon-md"></i>
                    </a>
                   <a href="javascript:;" class="btn btn-icon edit-menu" data-id="${a.id_menu}" data-bs-toggle="modal" data-bs-target="#basicModal">
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
                            { search: { placeholder: "Search Menu", text: "_INPUT_" } },
                            {
                                buttons: [
                                    {
                                        extend: "collection",
                                        className: "btn btn-label-secondary dropdown-toggle",
                                        text: '<span class="d-flex align-items-center gap-2"><i class="icon-base bx bx-export icon-sm"></i> <span class="d-none d-sm-inline-block">Export</span></span>',
                                        buttons: [
                                            {
                                                extend: "print",
                                                text: '<span class="d-flex align-items-center"><i class="icon-base bx bx-printer me-2"></i>Print</span>',
                                                className: "dropdown-item",
                                                exportOptions: {
                                                    columns: [2,3, 4, 5,6],
                                                    format: {
                                                        body: function (e, t, a) {
                                                            if (e.length <= 0) return e;
                                                            e = new DOMParser().parseFromString(e, "text/html").body.childNodes;
                                                            let s = "";
                                                            return (
                                                                e.forEach((e) => {
                                                                    e.classList && e.classList.contains("user-name") ? (s += e.lastChild.firstChild.textContent) : (s += e.textContent || e.innerText || "");
                                                                }),
                                                                s
                                                            );
                                                        },
                                                    },
                                                },
                                                customize: function (e) {
                                                    (e.document.body.style.color = config.colors.headingColor), (e.document.body.style.borderColor = config.colors.borderColor), (e.document.body.style.backgroundColor = config.colors.bodyBg);
                                                    e = e.document.body.querySelector("table");
                                                    e.classList.add("compact"), (e.style.color = "inherit"), (e.style.borderColor = "inherit"), (e.style.backgroundColor = "inherit");
                                                },
                                            },
                                            {
                                                extend: "csv",
                                                text: '<span class="d-flex align-items-center"><i class="icon-base bx bx-file me-2"></i>Csv</span>',
                                                className: "dropdown-item",
                                                exportOptions: {
                                                    columns: [2,3, 4, 5,6],
                                                    format: {
                                                        body: function (e, t, a) {
                                                            if (e.length <= 0) return e;
                                                            e = new DOMParser().parseFromString(e, "text/html").body.childNodes;
                                                            let s = "";
                                                            return (
                                                                e.forEach((e) => {
                                                                    e.classList && e.classList.contains("user-name") ? (s += e.lastChild.firstChild.textContent) : (s += e.textContent || e.innerText || "");
                                                                }),
                                                                s
                                                            );
                                                        },
                                                    },
                                                },
                                            },
                                            {
                                                extend: "excel",
                                                text: '<span class="d-flex align-items-center"><i class="icon-base bx bxs-file-export me-2"></i>Excel</span>',
                                                className: "dropdown-item",
                                                exportOptions: {
                                                    columns: [2,3, 4, 5,6],
                                                    format: {
                                                        body: function (e, t, a) {
                                                            if (e.length <= 0) return e;
                                                            e = new DOMParser().parseFromString(e, "text/html").body.childNodes;
                                                            let s = "";
                                                            return (
                                                                e.forEach((e) => {
                                                                    e.classList && e.classList.contains("user-name") ? (s += e.lastChild.firstChild.textContent) : (s += e.textContent || e.innerText || "");
                                                                }),
                                                                s
                                                            );
                                                        },
                                                    },
                                                },
                                            },
                                            {
                                                extend: "pdf",
                                                text: '<span class="d-flex align-items-center"><i class="icon-base bx bxs-file-pdf me-2"></i>Pdf</span>',
                                                className: "dropdown-item",
                                                exportOptions: {
                                                    columns: [2,3, 4, 5,6],
                                                    format: {
                                                        body: function (e, t, a) {
                                                            if (e.length <= 0) return e;
                                                            e = new DOMParser().parseFromString(e, "text/html").body.childNodes;
                                                            let s = "";
                                                            return (
                                                                e.forEach((e) => {
                                                                    e.classList && e.classList.contains("user-name") ? (s += e.lastChild.firstChild.textContent) : (s += e.textContent || e.innerText || "");
                                                                }),
                                                                s
                                                            );
                                                        },
                                                    },
                                                },
                                            },
                                            {
                                                extend: "copy",
                                                text: '<i class="icon-base bx bx-copy me-1"></i>Copy',
                                                className: "dropdown-item",
                                                exportOptions: {
                                                    columns: [2,3, 4, 5,6],
                                                    format: {
                                                        body: function (e, t, a) {
                                                            if (e.length <= 0) return e;
                                                            e = new DOMParser().parseFromString(e, "text/html").body.childNodes;
                                                            let s = "";
                                                            return (
                                                                e.forEach((e) => {
                                                                    e.classList && e.classList.contains("user-name") ? (s += e.lastChild.firstChild.textContent) : (s += e.textContent || e.innerText || "");
                                                                }),
                                                                s
                                                            );
                                                        },
                                                    },
                                                },
                                            },
                                        ],
                                    },
                                    {
                                        text: '<i class="icon-base bx bx-plus icon-sm me-0 me-sm-2"></i><span class="d-none d-sm-inline-block">Add New Menu</span>',
                                        className: "add-new btn btn-primary",
                                        attr: { "data-bs-toggle": "offcanvas", "data-bs-target": "#offcanvasAddUser" },
                                    },
                                ],
                            },
                        ],
                    },
                    bottomStart: { rowClass: "row mx-3 justify-content-between", features: ["info"] },
                    bottomEnd: { paging: { firstLast: !1 } },
                },
                language: {
                    sLengthMenu: "_MENU_",
                    search: "",
                    searchPlaceholder: "Search Menu",
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
                    e(3, ".user_role", "UserRole", "Select Type");
                    let a = document.createElement("select");
                    (a.id = "FilterTransaction"),
                        (a.className = "form-select text-capitalize"),
                        (a.innerHTML = '<option value="">Select Status</option>'),
                        document.querySelector(".user_status").appendChild(a),
                        a.addEventListener("change", () => {
                            var e = a.value ? `^${a.value}$` : "";
                            r.column(6).search(e, !0, !1).draw();
                        });
                    e = r.column(6);
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
                var e = document.querySelector(".datatables-menu");
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

        $(document).off("click", ".edit-menu").on("click", ".edit-menu", function () {
            debugger;
            let table = $(".datatables-menu").DataTable();
            let menuId = $(this).data("id");
            console.log("menu");
        
            // Find user details from DataTable
            let menu = table
                .rows()
                .data()
                .toArray()
                .find((m) => m.id_menu == menuId);
        
            if (menu) {
                // Populate form fields
                $("#menu_name").val(menu.name);
                $("#price").val(menu.price);
                $("#reduction").val(menu.reduction);
                $("#type").val(menu.type);
                $("#status").val(menu.status);
                $("#updateMenu").find("button[name ='api']").attr("url", "/menu/update/" + menu.id_menu + ":PUT");
                // Show modal
            }
            if (menu.image) {
                $("#previewImage_update").attr("src", '/storage/' + menu.image );
            }
        });

        $(document).off("click", ".delete-menu").on("click", ".delete-menu", function () {

            var menuId = $(this).data('id');
            var route = $(this).attr('url');
            var alert = $(this).attr('alert');           
            console.log("rouuuuteee"+route);
            AjaxFunction(menuId, route, alert);
            
        });

        $(document).on("Data", function () {
            Data.ajax.reload(null, false);
        });

      };
      