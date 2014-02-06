<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:modules/
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class modHelloWorldHelper
{
    /**
     * Retrieves the contents of the database 
     *
     * @param array $params An object containing the module parameters
     * @access public
     */    
    public static function getData( $id, $email)
    {
        $db = JFactory::getDbo();
        
        try 
        {
          $db -> transactionStart();

          $query = $db->getQuery(true);

          $query -> select($db->quoteName(array('Name', 'Unique_ID', 'Bod_Card', 'Telephone', 'Email', 'Amount_Paid', 'Payment_Method', 'Total_Amount_Due')))
                 -> from($db->quoteName('#__ticketverification'))
                 -> where($db->quoteName('Unique_ID')." = ".$db->quote($id));
          if (isset($email)) $query -> where($db->quoteName('Email')." = ".$db->quote($email));
          
          $db->setQuery($query);
          $results = $db->loadAssoc();

          $db->transactionCommit();
          return $results;
       }
       catch (Exception $e)
       {
         $db->transactionRollback();
         JErrorPage::render($e);
         
      }
    }
    public static function modifyDetails($id, $bodNum, $telNum)
    {
         $db = JFactory::getDbo();
         try
         {
           $db -> transactionStart();

           $query = $db -> getQuery(true);

           $fields = array(
             $db->quoteName('Bod_card') .  "='{$bodNum}'",
             $db->quoteName('Telephone') . "='{$telNum}'"
           );

           $conditions = array(
             $db->quoteName('Unique_ID') . "=$id"
           );

           $query->update($db->quoteName('#__ticketverification'))->set($fields)->where($conditions);

           $db->setQuery($query);
           $result = $db->execute();

           $db->transactionCommit();
        }
        catch (Exception $e)
        {
          $db->transactionRollback();
          JErrorPage::render($e);
        }
    }
}
?>
