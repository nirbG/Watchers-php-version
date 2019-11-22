

            $(".sectionWatchers .fa-minus").click(function (e) {
                var section=$(e.currentTarget).closest(".sectionWatchers");
                $($($(section).closest(".row")).find(".row")).slideUp("slow");
                $($(section).find(".fa-plus")).show();
                $($(section).find(".fa-minus")).hide();
            });
            $(".sectionWatchers .fa-plus").click(function (e) {
                var section=$(e.currentTarget).closest(".sectionWatchers");
                $($($(section).closest(".row")).find(".row")).slideDown("slow");
                $(".listInfo").hide();
                $($(section).find(".fa-plus")).hide();
                $($(section).find(".fa-minus")).show();
            });
            $(".sectionWatchersH .fa-minus").click(function (e) {
                var section=$(e.currentTarget).closest(".sectionWatchersH");
                $($($(section).closest(".row")).find(".row")).slideUp("slow");
                $($(section).find(".fa-plus")).show();
                $($(section).find(".fa-minus")).hide();
            });
            $(".sectionWatchersH .fa-plus").click(function (e) {
                var section=$(e.currentTarget).closest(".sectionWatchersH");
                $($($(section).closest(".row")).find(".row")).slideDown("slow");
                $(".listInfo").hide();
                $($(section).find(".fa-plus")).hide();
                $($(section).find(".fa-minus")).show();
            });/**
             sectionWatchersH
 * Created by User on 11/10/2018.
 */
