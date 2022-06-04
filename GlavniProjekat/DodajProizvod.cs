using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace GlavniProjekat
{
    public partial class DodajProizvod : Form
    {
        string connectionString = "datasource=127.0.0.1;port=3306;username=root;password=;database=projekat;";
        bool EmptyCheck()
        {
            if (String.IsNullOrEmpty(textBox1.Text) || String.IsNullOrEmpty(textBox2.Text) || String.IsNullOrEmpty(richTextBox1.Text) || String.IsNullOrEmpty(textBox3.Text))
                return true;
            return false;
        }
        void FillComboBox()
        {
            comboBox1.Items.Clear();
            MySqlConnection con = new MySqlConnection(connectionString);
            if (con.State == ConnectionState.Closed)
            {
                con.Open();
            }
            string selectquery2 = "select * from proizvodi";
            MySqlCommand selectcmd2 = new MySqlCommand(selectquery2, con);
            MySqlDataReader dataReader2 = selectcmd2.ExecuteReader();
            while (dataReader2.Read())
            {
                string sName = dataReader2.GetString("ime");
                comboBox1.Items.Add(sName);
            }
            dataReader2.Close();
            con.Close();
        }
        public DodajProizvod()
        {
            InitializeComponent();
            comboBox1.DropDownStyle = ComboBoxStyle.DropDownList;
        }
        
        private void button1_Click(object sender, EventArgs e)
        {
            MySqlConnection con = new MySqlConnection(connectionString);
            if (con.State == ConnectionState.Closed)
            {
                con.Open();
            }
            if (button1.Text == "Dodaj proizvod")
            {
                if (EmptyCheck())
                {
                    MessageBox.Show("Sva polja moraju biti popunjena");
                }
                else
                {
                    string selectquery = "select * from proizvodi where ime='" + textBox1.Text + "'";
                    string insertquery = "insert into Proizvodi(ime, cena, opis, image)" +
                                    "values ('" + textBox1.Text + "', '" + textBox2.Text +
                                    "', '" + richTextBox1.Text + "', '" + textBox3.Text + "');";
                    MySqlCommand selectcmd = new MySqlCommand(selectquery, con);
                    MySqlCommand insertcmd = new MySqlCommand(insertquery, con);
                    MySqlDataReader dataReader = selectcmd.ExecuteReader();
                    if (dataReader.HasRows)
                    {
                        MessageBox.Show("Proizvod sa takvim imenom već postoji");
                    }
                    else
                    {
                        dataReader.Close();
                        MessageBox.Show("Uspešno ste uneli proizvod");
                        insertcmd.ExecuteScalar();
                    }
                }
            }
            else if (button1.Text == "Izmeni proizvod")
            {
                string updatequery = "update proizvodi " +
                                     "set Ime = '" + textBox1.Text + "', Cena = " + textBox2.Text + ", Opis = '" + richTextBox1.Text + "', Image = '" + textBox3.Text + "' " +
                                     "where Ime = '" + textBox1.Text + "';";
                if (EmptyCheck())
                {
                    MessageBox.Show("Sva polja moraju biti popunjena");
                }
                else
                {
                    MessageBox.Show("Uspešno ste izmenili proizvod");
                    MySqlCommand updatecmd = new MySqlCommand(updatequery, con);
                    updatecmd.ExecuteScalar();
                }                   
            }
            else
            {
                string deletequery = "delete from proizvodi where Ime='" + textBox1.Text + "';";
                MessageBox.Show("Uspešno ste obrisali proizvod");
                MySqlCommand deletecmd = new MySqlCommand(deletequery, con);
                deletecmd.ExecuteScalar();
            }
            FillComboBox();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            button2.Enabled = false;
            button3.Enabled = true;
            button4.Enabled = true;
            comboBox1.Visible = false;
            textBox1.Visible = true;
            textBox2.Enabled = true;
            textBox3.Enabled = true;
            richTextBox1.Enabled = true;
            button1.Text = "Dodaj proizvod";
        }

        private void button3_Click(object sender, EventArgs e)
        {
            textBox1.Text = "";
            textBox2.Text = "";
            textBox3.Text = "";
            richTextBox1.Text = "";
            button2.Enabled = true;
            button3.Enabled = false;
            button4.Enabled = true;
            comboBox1.Visible = true;
            textBox1.Visible = false;
            textBox2.Enabled = true;
            textBox3.Enabled = true;
            richTextBox1.Enabled = true;
            button1.Text = "Izmeni proizvod";
            FillComboBox();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            textBox1.Text = "";
            textBox2.Text = "";
            textBox3.Text = "";
            richTextBox1.Text = "";
            button2.Enabled = true;
            button3.Enabled = true;
            button4.Enabled = false;
            comboBox1.Visible = true;
            textBox1.Visible = false;
            textBox2.Enabled = false;
            textBox3.Enabled = false;
            richTextBox1.Enabled = false;
            button1.Text = "Obriši proizvod";
            FillComboBox();
        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            MySqlConnection con = new MySqlConnection(connectionString);
            if (con.State == ConnectionState.Closed)
            {
                con.Open();
            }
            string selectquery3 = "select * from proizvodi where ime = '" + comboBox1.GetItemText(comboBox1.SelectedItem) + "';";
            MySqlCommand selectcmd3 = new MySqlCommand(selectquery3, con);
            MySqlDataReader dataReader3 = selectcmd3.ExecuteReader();
            dataReader3.Read();
            textBox1.Text = dataReader3.GetString("ime");
            textBox2.Text = dataReader3.GetString("cena");
            richTextBox1.Text = dataReader3.GetString("opis");
            textBox3.Text = dataReader3.GetString("image");
        }
    }
}
