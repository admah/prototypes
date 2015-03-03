(function ($) {
 
    var emails = [
  {
    index: 0,
    picture: "http://placehold.it/32x32",
    subject: "Hello! This is number 10 in a series of test messages.",
    body: "Est id aliqua quis velit. Do laboris non et cupidatat nulla anim commodo. Ipsum deserunt proident commodo quis incididunt et non culpa laboris ad aliquip nisi. Sunt eiusmod sunt esse voluptate occaecat nisi ut tempor laboris mollit ullamco. Ut amet veniam culpa pariatur velit. In sunt incididunt id consectetur velit adipisicing aute. Cupidatat veniam laborum nulla fugiat officia consequat esse adipisicing magna cupidatat fugiat nisi.\r\nVelit non ea adipisicing Lorem veniam amet ea ea. Occaecat id velit aute eiusmod consectetur irure do mollit minim nulla. Fugiat mollit pariatur sunt enim labore irure. In labore esse quis cupidatat consequat.\r\nLaboris nisi culpa nisi tempor occaecat ea ex aute qui consectetur minim do ad eu. Cillum mollit consectetur culpa exercitation consequat amet anim. Quis ipsum officia labore reprehenderit eiusmod sint voluptate qui deserunt nulla voluptate. Qui sunt consectetur quis consequat irure incididunt quis pariatur dolor laborum magna dolore deserunt. Cupidatat elit non incididunt commodo aliqua aute consequat fugiat esse. Amet ut quis reprehenderit eiusmod mollit tempor esse.\r\n",
    sent: "Thursday, March 27, 2014 7:38 AM"
  },
  {
    index: 1,
    picture: "http://placehold.it/32x32",
    subject: "Hello! This is number 6 in a series of test messages.",
    body: "Magna proident fugiat reprehenderit cupidatat commodo minim ad sunt aliquip commodo qui nisi consectetur ipsum. Elit laboris ex enim laborum. In nulla sit nisi pariatur cillum. Consectetur sunt ut sint eu ut. Ullamco non fugiat officia nostrud culpa reprehenderit magna cupidatat. Consectetur commodo et ullamco veniam laborum commodo ad consequat nulla dolore quis laboris. In ullamco culpa amet consectetur aute eu nostrud ex velit ullamco voluptate nisi enim cupidatat.\r\nNisi duis pariatur fugiat voluptate. Exercitation sit officia velit dolor ex adipisicing ex deserunt aliqua. Veniam do laborum eiusmod enim ad nostrud ex laborum sunt adipisicing commodo ullamco. Eu minim ea commodo sit labore non.\r\nLorem ipsum amet nisi in aute. Occaecat est anim consectetur laboris sunt deserunt eiusmod excepteur occaecat. Cupidatat tempor amet occaecat proident velit labore culpa labore cupidatat ullamco. Duis tempor qui do sunt officia ut qui ipsum sint laboris. In veniam aliquip sunt pariatur.\r\n",
    sent: "Sunday, March 30, 2014 11:30 AM"
  },
  {
    index: 2,
    picture: "http://placehold.it/32x32",
    subject: "Hello! This is number 10 in a series of test messages.",
    body: "Elit eiusmod est nostrud veniam elit veniam ullamco. Dolore dolore fugiat laborum in occaecat ea laboris et ea excepteur sit adipisicing. Fugiat velit esse et aliqua Lorem laboris et deserunt. Aliqua culpa sint labore adipisicing et sunt adipisicing amet excepteur do elit cupidatat. Lorem nisi nisi eiusmod sint veniam tempor. Labore cupidatat occaecat ea sit.\r\nSit fugiat laborum sit adipisicing ex veniam magna irure sit incididunt irure dolore cillum. Eu mollit officia excepteur magna cupidatat aute et id aute amet. Amet non eiusmod dolor aliqua laboris exercitation incididunt do commodo. Exercitation sit ad ullamco non ad velit cillum. Elit labore cupidatat mollit exercitation eiusmod exercitation ea ullamco consectetur ea minim.\r\nQui ullamco do sunt do id Lorem ipsum nisi aliqua excepteur labore dolore. Officia mollit sint in velit ea deserunt cupidatat aute amet id duis excepteur ex. Officia eiusmod minim et laboris excepteur reprehenderit esse qui enim labore labore minim commodo ex. Consequat consectetur nisi cillum ex aliqua ad do nulla pariatur dolore consequat. Duis id incididunt adipisicing id reprehenderit anim magna esse.\r\n",
    sent: "Friday, January 3, 2014 9:31 PM"
  },
  {
    index: 3,
    picture: "http://placehold.it/32x32",
    subject: "Hello! This is number 9 in a series of test messages.",
    body: "Qui sint sint est anim duis labore aliqua veniam mollit dolore fugiat deserunt culpa. Sit consectetur ipsum Lorem incididunt et Lorem non culpa incididunt veniam consectetur ex culpa. Dolor magna proident ea aliquip. Ut aute Lorem duis adipisicing pariatur incididunt adipisicing minim. Nostrud sit velit labore irure excepteur est cupidatat cupidatat non ex excepteur. Esse est in labore nulla aliquip reprehenderit qui magna exercitation aute in esse.\r\nExercitation deserunt aliqua aliqua incididunt et mollit aute ullamco. Elit ad aute nisi fugiat commodo tempor. Dolore id mollit cillum ut sit incididunt excepteur. Eiusmod reprehenderit do proident voluptate excepteur sit. Voluptate commodo amet velit aliquip adipisicing commodo exercitation fugiat deserunt culpa reprehenderit.\r\nExcepteur excepteur eu officia ullamco anim aliquip dolore laborum commodo aute quis fugiat. Adipisicing culpa eu ut ad et elit proident id occaecat excepteur. Magna amet deserunt nostrud elit velit et excepteur Lorem aliqua nostrud enim proident excepteur. Laboris in fugiat officia reprehenderit ex deserunt esse cillum laboris laboris amet proident sit. Qui Lorem laborum nostrud anim occaecat voluptate do consequat magna eu exercitation commodo est sint. Ipsum magna aliquip exercitation Lorem quis nulla pariatur consectetur minim proident do.\r\n",
    sent: "Wednesday, January 15, 2014 12:26 AM"
  },
  {
    index: 4,
    picture: "http://placehold.it/32x32",
    subject: "Hello! This is number 7 in a series of test messages.",
    body: "Nulla et ad culpa sint anim irure. Sunt sit nulla irure mollit deserunt voluptate cupidatat quis ad dolore do dolore. Esse velit reprehenderit nulla qui non aliquip esse amet adipisicing reprehenderit. Ad quis sunt pariatur mollit.\r\nDeserunt est sint aliqua officia deserunt et nostrud nisi quis id laboris est. Velit consectetur laboris anim nisi est. Officia non Lorem laboris aliqua in ut in fugiat anim et. Elit dolor eu mollit elit voluptate esse. Esse non esse ullamco fugiat aliqua eiusmod elit velit veniam. Consectetur consequat proident commodo sunt non duis. Consectetur et aute ad sint esse.\r\nDuis nulla tempor aute sit culpa deserunt ea fugiat ad consectetur. Sint ex ex nostrud non mollit laborum aliquip ullamco esse duis sint ullamco Lorem. Enim incididunt sit deserunt nulla eu qui dolore minim do reprehenderit nisi commodo. Ut in cupidatat sunt ut. Pariatur est adipisicing aute deserunt consequat cupidatat sunt incididunt nisi ipsum et.\r\n",
    sent: "Saturday, February 1, 2014 7:38 PM"
  }
];

var Email = Backbone.Model.extend({
    defaults: {
        picture: "http://placehold.it/32x32"
    }
});

var Inbox = Backbone.Collection.extend({
    model: Email
});

var EmailView = Backbone.View.extend({
    tagName: "article",
    className: "email-container",
    template: $("#emailTemplate").html(),

    events: {
    "click button.delete": "itemClicked"
    },

    itemClicked: function () {
        alert('clicked: ' + this.model.get('index'));
    },
 
    deleteEmail: function () {
        this.remove();
    },
 
    render: function () {
        var tmpl = _.template(this.template);
 
        this.$el.html(tmpl(this.model.toJSON()));
        return this;
    }
});

var InboxView = Backbone.View.extend({
    el: $("#emails"),
 
    initialize: function () {
        this.collection = new Inbox(emails);
        this.render();
    },
 
    render: function () {
        var that = this;
        _.each(this.collection.models, function (item) {
            that.renderEmail(item);
        }, this);
    },
 
    renderEmail: function (item) {
        var emailView = new EmailView({
            model: item
        });
        this.$el.append(emailView.render().el);
    }
});

var inbox = new InboxView();

} (jQuery));