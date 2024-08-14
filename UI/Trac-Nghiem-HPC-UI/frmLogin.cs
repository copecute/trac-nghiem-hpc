using DevExpress.XtraEditors;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Trac_Nghiem_HPC_UI
{
    public partial class frmLogin : DevExpress.XtraEditors.DirectXForm
    {
        public frmLogin()
        {
            InitializeComponent();
        }

        private void frmLogin_HtmlElementMouseClick(object sender, DevExpress.Utils.Html.DxHtmlElementMouseEventArgs e)
        {
            if (e.ElementId == "point _red")
            {
                var arg = new XtraMessageBoxArgs();
                arg.HtmlTemplate.Assign(htmlMesage);
                arg.Caption = "Thông báo";
                arg.Text = "Bạn có muốn thoát?";
                arg.DefaultButtonIndex = 0;
                var result = XtraMessageBox.Show(arg);
                if (result == DialogResult.Yes)
                {
                    this.Close();
                }
            }
            if (e.ElementId == "point _green")
            {
                this.WindowState = FormWindowState.Minimized;
            }
        }
    }
}