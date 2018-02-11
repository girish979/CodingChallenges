package PleasantSolution_2;

import java.util.*;
import java.lang.*;
import java.io.*;

class Main
{
    public static class CustomNode
    {
        public String Title;
        public CustomNode Parent;
        public ArrayList<CustomNode> Children;
        
        public CustomNode(String title, CustomNode parent)
        {
            Title = title;
            Parent = parent;
            Children = new ArrayList<CustomNode>();
            
            if(Parent!=null)
              Parent.Children.add(this);
        }
        
        public CustomNode Find(String path)
        {
            if (path.equals(Title))
                return this;

            String[] pieces = path.split("/");
    
	        for (CustomNode child : Children) {
                if (child.Title.equals(pieces[1]))
                    return child.Find(path.substring(Title.length() + 1));
            }
    
            return null;
        }
    }
	
	public static void main (String[] args) throws java.lang.Exception
	{
	    BufferedReader console = new BufferedReader(new InputStreamReader(System.in));
        
        //Build a test tree (matches the example)
	    CustomNode root = new CustomNode("Root", null);
	    CustomNode userData = new CustomNode("UserData", root);
	    CustomNode ud_browser = new CustomNode("Browser", userData);
	    CustomNode ud_word = new CustomNode("Word", userData);
	    CustomNode priv = new CustomNode("Private", userData);
	    CustomNode priv_word = new CustomNode("Word", priv);
	    
	    CustomNode windows = new CustomNode("Windows", root);
	    CustomNode programs = new CustomNode("Programs", root);
	    CustomNode notepad = new CustomNode("Notepad", programs);
	    CustomNode prog_word = new CustomNode("Word", programs);
	    CustomNode prog_browser = new CustomNode("Browser", programs);

	    CustomNode custom1 = new CustomNode(console.readLine(), root);
	    CustomNode custom2 = new CustomNode(console.readLine(), custom1);
	    CustomNode custom3 = new CustomNode(console.readLine(), custom2);
	    CustomNode target = root.Find(console.readLine());
	    
		System.out.println(GetShortestUniqueQualifier(root, target));
    }
	
	static void LevelOrder(CustomNode root, Map<String, Integer> mapOfList)
	{
		Queue<CustomNode> q = new LinkedList<CustomNode>();
		q.offer(root);
		while(!q.isEmpty())
		{
			CustomNode node = q.poll();
			ArrayList childs = node.Children;
			Iterator iter = childs.iterator();
		     while (iter.hasNext()) {
		    	 CustomNode temp = (CustomNode)iter.next();
		    	 if(temp !=null)
		    	 q.offer(temp);
		     }
			if(node != null)
			{
				if(!mapOfList.containsKey(node.Title))
					mapOfList.put(node.Title,  1);
				else
					mapOfList.put(node.Title,  mapOfList.get(node.Title)+1);
			}
		}
	}
	
	public static String GetShortestUniqueQualifier(CustomNode root, CustomNode target)
	{
		Map<String, Integer> mapOfList = new HashMap<String, Integer>();
		String retString = "";
		
		//Traverse
		LevelOrder(root,mapOfList);
		
		//GetFull Path
		
		ArrayList<String> path = new ArrayList<String>(); 		
		path.add(target.Title);
		
		CustomNode temporary = target.Parent;
		while(temporary != null)
		{
			path.add(temporary.Title);
			temporary = temporary.Parent;
		}
		
		int pathLevels= path.toArray().length;
		int requiredLevels = 0;
		
		for(int i=0;i<pathLevels;i++)
		{
			if(mapOfList.get(path.get(i)) == 1)
				break;
			else requiredLevels++;
		}
		
		if(requiredLevels>= path.size())
			requiredLevels=path.size()-1;
		for(int i=requiredLevels;i>=0;i--)
			retString +=path.get(i) + "/";
		
		retString = retString.substring(0, retString.length()-1);
			
	    return retString;
	}

}
